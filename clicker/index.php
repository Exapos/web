<?php

require "../bootstrap.php";

if ($user) {
    // daám mu hru
    require "game.html";
} else {
    header('Location: /login/index.html');
}
