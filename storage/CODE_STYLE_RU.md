Tradechange Стиль Кода
===============================

## Общее

- Файлы ДОЛЖНЫ использовать только `<?php`, `?>` или `<?=` теги, НЕЛЬЗЯ использовать `<?`.
- В конце КАЖДОГО файла должна быть пустая строка.
- Файлы содержащие PHP код ДОЛЖНЫ быть в кодировке UTF-8 without BOM.
- Код ДОЛЖЕН использовать 4 пробела для отступов, а не TAB.
- Если файл содержит только PHP код он НЕ ДОЛЖЕН иметь в конце файла `?>`.
- НЕЛЬЗЯ добавлять пробелы в конце строки, в конце строки должен быть либо символы, либо ничего.
- Окончание разрешений всех файлов, в которых содержится PHP код ДОЛЖНО заканчиваться на `.php`.
- В файле НЕ ДОЛЖНО быть двух новых строк подряд.
- Название переменных принято писать только на английском.
- Зависимоти моделей писать сокращённым вариантом в самом конце класса.


Variables                                   - lower_underscore
Properties, method names, function names    - loweCamelCase
Class names                                 - CamelCase
Boolean                                     - with is_ prefix
Private class members                       - with starting underscore
Model relation methods                      - lower_underscore

- Tabs and indents

```php
<?php
function foo() {
    if (isset($x) && $x > 5) {
        echo "bar";
    }
    return
        "string";
}
```

- Spaces

```php
<?php
declare(strict_types = 1);

namespace App\Models;

use App\Helpers\AppHelper;

class Foo extends Models {
    public function foo($x, $z) {
        global $k, $s1;
        $obj->foo()->bar();
        $arr = [0 => 'zero', 1 => 'one'];
        call_func(function () {
            return 0;
        });
        for ($i = 0; $i < $x; $i++) {
            $y += ($y ^ 0x123) << 2;
        }
        $k = $x > 15 ? 1 : 2;
        $k = $x ?: 0;
        $k = $x ?? $z;
        $k = $x <=> $z;
        do {
            try {
                if (!0 > $x && !$x < 10) {
                    while ($x != $y) {
                        $x = f($x * 3 + 5);
                    }
                    $z += 2;
                } elseif ($x > 20) {
                    $z = $x << 1;
                } else {
                    $z = $x | 2;
                }
                $j = (int)$z;
                switch ($j) {
                    case 0:
                        $s1 = 'zero';
                        break;
                    case 2:
                        $s1 = 'two';
                        break;
                    default:
                        $s1 = 'other';
                }
            } catch (\Exception $e) {
                echo $val{'foo' . $num}[$cell{$a}];
            } finally {
                // do something
            }
        } while ($x < 0);
    }
}

function bar() : Foo {
    // code
}

?>
<div><?= foo() ?></div>
```

Wrapping


```php
<?php

namespace A {

	function foo() {
		return 0;
	}

	function bar(
		$x,
		$y, int $z = 1
	) {
		$x = 0;
		// $x = 1;
		do {
			$y += 1;
		} while ($y < 10);
		
		if (TRUE) {
			$x = 10;
		} elseif ($y < 10) {
			$x = 5;
		} elseif (TRUE) {
			$x = 5;
		}
		
		for ($i = 0; $i < 10; $i ++) {
			$yy = $x > 2 ? 1 : 2;
		}
		
		while (TRUE) {
			$x = 0;
		}
		do {
			$x += 1;
		} while (TRUE);
		
		foreach (
			[
				"a" => 0,
				"b" => 1,
				"c" => 2,
			] as $e1
		) {
			echo $e1;
		}
		$count = 10;
		$x     = [
			"x",
			"y",
			[
				1 => "abc",
				2 => "def",
				3 => "ghi",
			],
		];
		$zz    = [
			0.1,
			0.2,
			0.3,
			0.4,
		];
		bar(
		    0,
		    bar(
		        1,
		        "b"
		    )
		 );
	}

	abstract class Foo extends
		FooBaseClass implements Bar1,
		Bar2, Bar3 {

		var $numbers = [
            "one",
            "two",
            "three",
            "four",
            "five",
            "six",
        ];
		
		var $v = 0;
		public $path = "root";

		const FIRST = 'first';

		const SECOND = 0;

		const Z = - 1;

		function bar(
			$v,
			$w = "a"
		) {
			$y      = $w;
			$result = foo( "arg1",
				"arg2",
				10 );
			switch ( $v ) {
				case 0:
					return 1;
				case 1:
					echo '1';
					break;
				case 2:
					break;
				default:
					$result = 10;
			}

			return $result;
		}

		public static function fOne(
			$argA, $argB, $argC, $argD,
			$argE, $argF, $argG, $argH
		) {
			$x = $argA + $argB + $argC
			     + $argD + $argE + $argF
			     + $argG + $argH;
			list( $field1, $field2,
				$field3, $filed4,
				$field5, $field6 )
				= explode( ",", $x );
			fTwo( $argA, $argB, $argC,
				fThree( $argD, $argE,
					$argF, $argG,
					$argH ) );
			$z      = $argA
			          == "Some string"
				? "yes" : "no";
			$colors = [
				"red",
				"green",
				"blue",
				"black",
				"white",
				"gray",
			];
			$count  = count( $colors );
			for (
				$i = 0; $i < $count;
				$i ++
			) {
				$colorString
					= $colors[ $i ];
			}
		}

		function fTwo(
			$strA, $strB, $strC, $strD
		) {
			if ( $strA == "one"
			     || $strB == "two"
			     || $strC == "three" ) {
				return $strA + $strB
				       + $strC;
			}
			$x = $foo->one( "a", "b" )
			         ->two( "c", "d",
				         "e" )
			         ->three( "fg" )
			         ->four();
			$y = a()->b()->c();

			return $strD;
		}

		function fThree(
			$strA, $strB, $strC, $strD,
			$strE
		) {
			try {
			}
			catch ( Exception $e ) {
				foo();
			} finally {
				// do something
			}

			return $strA + $strB + $strC
			       + $strD + $strE;
		}

		protected abstract function fFour(
		);

	}
}
```
