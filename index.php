<?php
include 'menu.php';

$sessionId   = $_POST['sessionId'] ?? '';
$phoneNumber = $_POST['phoneNumber'] ?? '';
$serviceCode = $_POST['serviceCode'] ?? '';
$text        = $_POST['text'] ?? '';

$menu = new Menu($text, $sessionId, $phoneNumber);
$text = $menu->middleware($text);

$isRegistered = $menu->isRegistered();

if ($text == "" && !$isRegistered) {
    $menu->mainMenuUnregistered();
} else if ($text == "" && $isRegistered) {
    $menu->mainMenuRegistered();
} else if (!$isRegistered) {
    $textArray = explode("*", $text);
    if ($textArray[0] == "1") {
        $menu->menuRegister($textArray);
    } else {
        echo "END Invalid choice.";
    }
} else {
    $textArray = explode("*", $text);
    switch ($textArray[0]) {
        case "1":
            $menu->menuSendMoney($textArray);
            break;
        case "2":
            $menu->menuWithdrawMoney($textArray);
            break;
        case "3":
            $menu->menuCheckBalance($textArray);
            break;
        default:
            echo "END Invalid choice.";
    }
}
?>
