<?php

require_once 'util.php';
require_once 'html.php';

use \Treffynnon\Html as H;

echo H\div(
    'The content of my div appears here.',
    [H\attr('class', ['my-section', 'highlight'])]
);

// Outputs the following HTML:
//
// <div class="my-section highlight">
//     The content of my div appears here.
// </div>
