<?php

declare(strict_types=1);

function is_input_empty(string $oldPass, string $newPass1, string $newPass2)
{
    if(empty($oldPass) || empty($newPass1) || empty($newPass2))
    {
        return true;
    }
    else
    {
        return false;
    }
}
function is_password_wrong(string $pwd, string $hashPwd)
{
    if(!password_verify($pwd, $hashPwd))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function are_password_diff(string $pwd1, string $pwd2)
{
    if($pwd1 !== $pwd2)
    {
        return true;
    }
    else
    {
        return false;
    }
}

?>