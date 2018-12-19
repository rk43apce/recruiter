<?php
interface a
{
    public function foo();
}

interface b
{
    public function bar();
}

interface c extends a, b
{
    public function baz();
}

class Interface implements c
{
    public function foo()
    {
		echo 'interface foo';
    }

    public function bar()
    {
		echo 'interface bar';
    }

    public function baz()
    {
		echo 'interface baz';
    }
}
