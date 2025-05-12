<?php
include_once 'connection.php';
include_once 'sms.php';

class Menu {
    protected $text;
    protected $sessionId;
    protected $phoneNumber;
    protected $conn;

    function __construct($text, $sessionId, $phoneNumber) {
        $this->text = $text;
        $this->sessionId = $sessionId;
        $this->phoneNumber = $phoneNumber;

        $db = new Database();
        $this->conn = $db->conn;

        $this->logSessionActivity($text);
    }

    private function logSessionActivity($activity) {
        $stmt = $this->conn->prepare("INSERT INTO sessions (session_id, phone_number, activity) VALUES (?, ?, ?)");
        $stmt->execute([$this->sessionId, $this->phoneNumber, $activity]);
    }

    public function isRegistered() {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE phone_number = ?");
        $stmt->execute([$this->phoneNumber]);
        return $stmt->rowCount() > 0;
    }

    public function mainMenuUnregistered() {
        echo "CON Welcome to XYZ MOMO\n1. Register";
    }

    public function menuRegister($textArray) {
        $level = count($textArray);
        if ($level == 1) {
            echo "CON Enter your full name";
        } else if ($level == 2) {
            echo "CON Set your PIN";
        } else if ($level == 3) {
            echo "CON Confirm your PIN";
        } else if ($level == 4) {
            $name = $textArray[1];
            $pin = $textArray[2];
            $confirm = $textArray[3];
            $balance=400.00;

            if ($pin != $confirm) {
                echo "END PINs do not match.";
            } else {
                $stmt = $this->conn->prepare("INSERT INTO users (phone_number, full_name, pin,balance) VALUES (?, ?, ?,?)");
                $stmt->execute([$this->phoneNumber, $name, $pin,$balance]);
                echo "END Registration successful. Welcome $name!";
            }
        }
    }

    public function mainMenuRegistered() {
        echo "CON Welcome to XYZ MOMO\n1. Send Money\n2. Withdraw Money\n3. Check Balance";
    }

    public function menuSendMoney($textArray) {
        $level = count($textArray);
        if ($level == 1) {
            echo "CON Enter recipient number";
        } else if ($level == 2) {
            echo "CON Enter amount";
        } else if ($level == 3) {
            echo "CON Enter your PIN";
        } else if ($level == 4) {
            $recipient = $textArray[1];
            $amount = $textArray[2];
            $pin = $textArray[3];

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE phone_number = ? AND pin = ?");
            $stmt->execute([$this->phoneNumber, $pin]);

            if ($stmt->rowCount() == 0) {
                echo "END Invalid PIN.";
                return;
            }

            $user = $stmt->fetch();
            if ($user['balance'] < $amount) {
                echo "END Insufficient funds.";
                return;
            }

            $this->conn->beginTransaction();

            $this->conn->prepare("UPDATE users SET balance = balance - ? WHERE phone_number = ?")
                ->execute([$amount, $this->phoneNumber]);

            $this->conn->prepare("UPDATE users SET balance = balance + ? WHERE phone_number = ?")
                ->execute([$amount, $recipient]);

            $this->conn->prepare("INSERT INTO transactions (sender_phone, recipient_phone, amount, type) VALUES (?, ?, ?, 'send')")
                ->execute([$this->phoneNumber, $recipient, $amount]);

            $this->conn->commit();

            echo "END Sent Rwf $amount to $recipient.";
        }
    }

    public function menuWithdrawMoney($textArray) {
        $level = count($textArray);
        if ($level == 1) {
            echo "CON Enter amount to withdraw";
        } else if ($level == 2) {
            echo "CON Enter agent code";
        } else if ($level == 3) {
            echo "CON Enter your PIN";
        } else if ($level == 4) {
            $amount = $textArray[1];
            $agentCode = $textArray[2];
            $pin = $textArray[3];
    
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE phone_number = ? AND pin = ?");
            $stmt->execute([$this->phoneNumber, $pin]);
    
            if ($stmt->rowCount() == 0) {
                echo "END Incorrect PIN.";
                return;
            }
    
            $user = $stmt->fetch();
    
            if ($user['balance'] < $amount) {
                echo "END Insufficient balance.";
                return;
            }
    
            $agentStmt = $this->conn->prepare("SELECT * FROM agents WHERE agent_code = ?");
            $agentStmt->execute([$agentCode]);
    
            if ($agentStmt->rowCount() == 0) {
                echo "END Invalid agent code.";
                return;
            }
    
            $agent = $agentStmt->fetch();
    
            if ($agent['balance'] < $amount) {
                echo "END Agent has insufficient funds to process this withdrawal.";
                return;
            }
    
            try {
                $this->conn->beginTransaction();
    
                $this->conn->prepare("UPDATE users SET balance = balance - ? WHERE phone_number = ?")
                    ->execute([$amount, $this->phoneNumber]);
    
                $this->conn->prepare("UPDATE agents SET balance = balance - ? WHERE agent_code = ?")
                    ->execute([$amount, $agentCode]);
    
                $this->conn->prepare("INSERT INTO transactions (sender_phone, amount, type, agent_code) VALUES (?, ?, 'withdraw', ?)")
                    ->execute([$this->phoneNumber, $amount, $agentCode]);
    
                $this->conn->commit();
    
                echo "END Withdraw Rwf $amount successful. Collect from agent $agentCode.";
            } catch (Exception $e) {
                $this->conn->rollBack();
                echo "END Withdrawal failed. Try again later.";
            }
        }
    }
    

   public function menuCheckBalance($textArray) {
    $level = count($textArray);

    if ($level == 1) {
        echo "CON Enter PIN";
    } else {
        $pin = $textArray[1];
        $stmt = $this->conn->prepare("SELECT balance FROM users WHERE phone_number = ? AND pin = ?");
        $stmt->execute([$this->phoneNumber, $pin]);

        if ($stmt->rowCount() == 0) {
            echo "END Incorrect PIN.";
        } else {
            $balance = $stmt->fetch()['balance'];

            // Send SMS
            $msg = "Your MoMo balance is Rwf $balance. Thank you for using our service.";
            $sms = new Sms($this->phoneNumber); // assuming $this->phoneNumber is the user's phone
            $result = $sms->sendSMS($msg, $this->phoneNumber);

            if ($result['status'] == "Success" || $result['status'] == "success") {
                echo "END Thank you for using MoMo service. Your balance is Rwf $balance. A confirmation SMS has been sent.";
            } else {
                echo "END Thank you for using MoMo service. Your balance is Rwf $balance. (SMS failed to send)";
            }
        }
    }
}


    public function middleware($text) {
        return $this->goBack($this->goToMainMenu($text));
    }

    public function goBack($text) {
        $arr = explode("*", $text);
        while (($i = array_search("98", $arr)) !== false) {
            array_splice($arr, max(0, $i - 1), 2);
        }
        return join("*", $arr);
    }

    public function goToMainMenu($text) {
        $arr = explode("*", $text);
        while (($i = array_search("99", $arr)) !== false) {
            $arr = array_slice($arr, $i + 1);
        }
        return join("*", $arr);
    }
}
?>
