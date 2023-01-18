<?php
class FruitPicker { // класс Сборщика фруктов

    private static $id = 1;
    private $tree = [ // переменная с деревьями (фруктовым садом)
        ["id" => 0, "type" => "apple", "numfruits" => 30], // пример яблони // 40-50 // 50 - 180 гр 
        ["id" => 1, "type" => "pear", "numfruits" => 10], // пример груши // 0-20 // 130 - 170 гр
    ];
    private $basket = ["apple" => 0, "pear" => 0];

    public function setTree(string $type, int $numfruits) { // метод с добавлением дерева в сад

        // Проверка данных
        // Проверка на дерево
        if ($type != "apple" && $type != "pear")
            $type = 'apple'; // если ввели непонятное дерево будем считать, что это яблоня
        // Проверка на количество плодов на дереве
        if ($type == 'apple' && ($numfruits < 40 || $numfruits > 50))
            $numfruits = 45;
        if ($type == 'pear' && ($numfruits < 0 || $numfruits > 20))
            $numfruits = 10;
        // P.S. При необходимости вместо переопределения вы можете вывести сообщение об ошибке
        //$id = array_key_last($this->tree); // array_key_last Возвращает последний ключ массива (PHP 7 >= 7.3.0, PHP 8) => работает с версии PHP 7.3.0
        //$id++; // По условию деревья не удаляются, поэтому в id буду просто добавлять 1 и не боятся за повторение
        ++self::$id;
        //var_dump(self::$id);
        //exit();
        $temp = [ ["id" => self::$id, 'type' => $type, "numfruits" => $numfruits] ]; // новое дерево в нашем саду <3
        $this->tree = array_merge($this->tree, $temp); // сложение массивов
    }

    public function fruitPicking() {
        $nfa = 0; // num fruits apple
        $nfp = 0; // num fruits pear
        foreach ($this->tree as $key => $value) {
            $temp = null;
            foreach ($this->tree[$key] as $key2 => $value2) {
                if($value2 == 'apple') $temp = "apple";
                if($value2 == 'pear') $temp = "pear";
                if($temp == 'apple' && $key2 == "numfruits") {
                    $nfa += $value2;
                    $this->tree[$key][$key2] = 0; // раз плоды собрали то на дереве их 0
                }
                if($temp == 'pear' && $key2 == "numfruits") {
                    $nfp += $value2;
                    $this->tree[$key][$key2] = 0;
                }
            }
        }
        $temp = [
           "apple" => ["type" => "apple", "numfruits" => $nfa],
           "pear" => ["type" => "pear", "numfruits" => $nfp],
        ];
        $this->basket['apple'] += $nfa;
        $this->basket['pear'] += $nfp;
        return $temp;
    }

    public function getBasket() {
        echo "Яблок собрано: " . $this->basket['apple'] . "<br>";
        echo "Груш собрано: " . $this->basket['pear'] . "<br>";
    }

}

$obj = new FruitPicker();

for ($i = 0; $i < 14; $i++) { 
    $obj->setTree("pear", 16); // Добавление груш в сад
}

for ($i = 0; $i < 9; $i++) { 
    $obj->setTree("apple", 42); // Добавление яблонь в сад
}

echo "<pre>";
print_r($obj); // Вывод всех деревьев
echo "</pre>";

$obj->fruitPicking(); // сбор урожая

$obj->getBasket(); // вывод количества собранных плодов

echo "<pre>";
print_r($obj); // Вовод всех деревьев (уже без плодов)
echo "</pre>";
?>
