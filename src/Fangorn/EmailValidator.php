<?php

namespace Fangorn;

class EmailValidator {

    public function isValid(string $adderess): bool {
        $username = '([a-z_\'0-9а-яё]+|\"[a-z_\'\,0-9а-яё]+\")';
        $host     = '(([a-z\-а-яё]+\.)+([a-zа-яё]+)|localhost)';

        // TODO: Может быть любой уровень домена test@a.b.c.d.e.f.g.ru
        $pattern = '/^' . $username . '@' . $host . '$/iu';
        return preg_match($pattern, $adderess);
    }

}
