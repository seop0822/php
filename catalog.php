<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    list($form_errors, $input) = validate_from();
    if ($form_errors) {
        show_form($form_errors);
    } else {
        process_form();
    }
} else {
    show_form();
}

function process_form()
{
    print $_POST['name'] . "님 안녕하세요.";
}

function show_form($errors = array())
{
    if ($errors) {
        print '다음 항목을 수정해주세요.: <ul><li>';
        print implode('</li><li>', $errors);
        print '</li></ul>';
    }
    print<<<_HTML_
    <form method="POST" action="$_SERVER[PHP_SELF]">
    이름: <input type="text" name="name">
    <br/>
    가격: <input type="text" name="price">
    <br/>
    나이: <input type="text" name="age">
    <input type="submit" value="인사">
    </form>
    _HTML_;
}

function validate_from()
{
    $errors = array();
    $input = array();

    $input['age'] = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, array('options' => array('min_range' => 18, 'max_range' => 65)));
    if (is_null($input['age']) || $input['age'] === false) {
        $errors[] = '18세와 65세 사이의 나이를 정확하게 입력해주세요';
    }

    $input['price'] = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    if (is_null($input['price']) || ($input['price'] === false) || ($input['price'] < 10.00) || ($input['price'] > 50.00)) {
        $errors[] = '가격을 정확하게 입력해주세요';
    }

    $input['name'] = trim($_POST['name'] ?? '');
    if (strlen($input['name']) == 0) {
        $errors[] = '이름을 입력해주세요';
    }

//    if(strlen($_POST['my_mail']) == 0){
//        $errors[] = '이메일 주소를 입력해주세요';
//    }
    return array($errors, $input);
}


