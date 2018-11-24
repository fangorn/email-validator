<?php

namespace Fangorn;

use PHPUnit\Framework\TestCase;

class EmailValidatorTest extends TestCase {
    /**
     * @dataProvider validEmails()
     */
    public function testValidEmails(string $email): void {
        assertTrue((new EmailValidator())->isValid($email));
    }

    public function validEmails(): array {
        return [
            '#1'  => ['fabien@symfony.com'],
            '#2'  => ['example@example.co.uk'],
            '#3'  => ['fabien_potencier@example.fr'],
            '#4'  => ['example@localhost'],
            '#5'  => ['fab\'ien@symfony.com'],
            '#6'  => ['инфо@письмо.рф'],
            '#7'  => ['"username"@example.com'],
            '#8'  => ['"user,name"@example.com'],
            '#9'  => ['1500111@профи-инвест.рф'],
            '#10' => ['fabien@test.example.booooo.symfony.com'],
        ];
    }

    /**
     * @dataProvider invalidEmails()
     */
    public function testInvalidEmails(string $email): void {
        assertFalse((new EmailValidator())->isValid($email));
    }

    public function invalidEmails(): array {
        return [
            "#1" =>  ['test@example.com test'],
            "#2" =>  ['user  name@example.com'],
            "#3" =>  ['user   name@example.com'],
            "#4" =>  ['example.@example.co.uk'],
            "#5" =>  ['example@example@example.co.uk'],
            "#6" =>  ['(test_exampel@example.fr]'],
            "#7" =>  ['example(example]example@example.co.uk'],
            "#8" =>  ['.example@localhost'],
            "#9" =>  ['ex\ample@localhost'],
            "#10" => ['example@local\\host'],
            "#11" => ['example@localhost\\\\'],
            "#12" => ['example@localhost.'],
            "#13" => ['user name@example.com'],
            "#14" => ['username@ example . com'],
            "#15" => ['example@(fake].com'],
            "#16" => ['example@(fake.com'],
            "#17" => ['username@example,com'],
            "#18" => ['usern,ame@example.com'],
            "#19" => ['user[na]me@example.com'],
            "#21" => ['"@iana.org'],
            "#22" => ['""\"@iana.org'],
            "#23" => ['test"test@iana.org'],
            "#24" => ['test""test"@iana.org'],
            "#25" => ['test"."test"@iana.org'],
            "#26" => ['test".test@iana.org'],
            "#27" => ['test\"@iana.org'],
            "#28" => ['test@iana/icann.org'],
            "#29" => ['test@foo;bar.com'],
            "#30" => ['test;123@foobar.com'],
            "#31" => ['test@example..com'],
            "#32" => ['email.email@email."'],
            "#33" => ['test@email>'],
        ];
    }
}
