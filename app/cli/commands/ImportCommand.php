<?php

class ImportCommand extends CConsoleCommand
{

    public function actionFixEvents()
    {
        $data = array(
            1 => 111,
            2 => 112,
            3 => 113,
            4 => 114,
            5 => 115,
            6 => 116,
            7 => 117,
            8 => 118
        );

        foreach ($data as $old => $new) {
          echo "\n $old => $new count = ".
              Yii::app()->db->createCommand()->update(Event::model()->tableName(),
                array('type' => $new),
                'type=:old', array(':old' => $old)
            );
        }
    }

    /**
     * Импорт новостей из разных таблиц старого сайта в одну таблицу Event в текущем
     */
    public function actionNews()
    {
        printf("\033[33;1mImport News\033[m\n");

        // таблицы для импорта в новости
        $tables = array(
            1 => array('name' => 'news', 'fields' => array('news', 'header', 'date', 'time')),
            2 => array('name' => 'economy', 'fields' => array('news', 'header', 'date', 'time')),
            3 => array('name' => 'docs', 'fields' => array('docs', 'header', 'date', 'time', 'docnumber', 'docdate', 'doctype', 'prinorgan')),
            4 => array('name' => 'review', 'fields' => array('review', 'header', 'date')),
            5 => array('name' => 'logistic', 'fields' => array('logistic', 'header', 'date')),
            6 => array('name' => 'practice', 'fields' => array('practice', 'header', 'date')),
            7 => array('name' => 'evroazs', 'fields' => array('evroazs', 'header', 'date')),
            8 => array('name' => 'vtorossii', 'fields' => array('vtorossii', 'header', 'date')),
        );

        // очистим таблицу перед импортом
        Yii::app()->db->createCommand()->truncateTable('event');


        foreach ($tables as $type => $table) {

            printf("\033[32;1m\n\n{$table['name']} BEGIN >>>\033[m\n");

            $sql = "SELECT n," . implode(',', $table['fields']) . " FROM {$table['name']}";
            $dataReader = Yii::app()->db->createCommand($sql)->query();


            foreach ($dataReader as $row) {

                $Event = new Event();
                $Event->type = $type;
                $Event->status = $Event::STATUS_PUBLISHED;
                $Event->content = $row[reset($table['fields'])];

                if ($type == 3) {
                    $Event->title = trim($row['doctype']) . ' ' . trim($row['prinorgan']) . ' от ' . trim($row['docdate']) . ' ' . trim($row['docnumber']);
                } else {
                    $Event->title = $row['header'];
                }

                $Event->pub_date = $this->getNewsDate($row);

                $Event->save();
                if ($Event->hasErrors()) {
                    printf("\033[31;1m\n" . print_r($Event->getErrors(), true) . " \033[m\n");
                } else {
                    printf("\033[30;1m{$Event->id}({$row['n']}) \033[m");
                }

            }
            printf("\033[32;1m\n{$table['name']} END <<<\033[m\n\n");
        }

        printf("\033[36;1m---=  WELL DONE!  =--------------------------------------\033[m\n");
    }


    /**
     * Обработаем дату новости. Учтем баги которые могут быть в БД
     * @param $row string строка импорта
     * @return string дата новости
     */
    private function getNewsDate($row)
    {
        static $prevDate;


        if (empty($row['time'])) $row['time'] = '00:00:00';

        if ($row['date']) {// берем указанную дату

            // вытащим только дату, т.к. бывает еще разный хлам в этом поле
            $row['date'] = trim($row['date'], ' .');
            if (preg_match("/\d{1,2}\.\d{2}\.\d{2,4}/u", $row['date'], $matches)) {
                $row['date'] = reset($matches);
            }
            // год иногда бывает четырех значным, переделаем его в двузначный
            $row['date'] = explode('.', $row['date']);
            $row['date'][2] = substr($row['date'][2], -2);
            $row['date'] = implode('.', $row['date']);

            $date = date_create_from_format('d.m.y H:i:s', $row['date'] . ' ' . $row['time']);

        } elseif ($prevDate) {// берем предыдущую дату
            $date = date_create_from_format('Y-m-d H:i:s', $prevDate);
        } else {// берем текущую дату
            $date = new DateTime();
        }

        return $prevDate = $date->format('Y-m-d H:i:s');
    }
}