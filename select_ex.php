<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $defaults = $_POST;
} else {
    $defaults = array('delivery' => 'yes',
        'size' => 'medium',
        'main_dish' => array('taro', 'tripe'),
        'sweet' => 'cake');
}

$sweets = array('puff' => '참깨 퍼프',
    'sqare' => '코코넛 우유 젤리',
    'cake' => '흑설탕 케이크',
    'ricemeat' => '찹쌀경단');

print '<select name="sweet">';

foreach ($sweets as $option => $label) {
    print '<option value="' .$option .'"';
    if ($option == $defaults['sweet']) {
        print '  selected';
    }
    print "> $label</option>\n";
}
print '</select>';

