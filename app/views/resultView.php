<?php

class ResultView
    {
        private $model;
        
        public function __construct($model)
        {
            $this->model = $model;
        }

        private function showPageTop()
        {
            echo '
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Results</title>
                <link rel="stylesheet" href="./assets/styles/result-styles.css">
            </head>

            <body>
                <form action="" method="post">
                    <input type="submit" value="All" name="all">
                </form>
                <form action="" method="post">
                    <input type="submit" value="Sort by date" name="by-date">
                </form>
                <form action="" method="post">
                    <input type="submit" value="Sort by name" name="by-name">
                </form>
            <br>
            ';
        }

        private function makeEmailButtons()
        {
            foreach ($this->model->capitalisedBtnTexts as $btnText) {
                echo "<form action='' method='post'><input type='submit'value='$btnText'name='$btnText'></form>";
            }
        }

        private function showSearchInput()
        {
            echo 
            '<br>
            <form action="" method="post">
                <input type="text" placeholder="search for..." name="search-input">
                <input type="submit" value="Search" name="search">
            </form>';
        }

        private function showEmails($q)
        {
            while ($row = $q->fetch()) {
                echo  '
                <tr>
                    <td>
                        <form action="" method="post">
                            <input type="submit" value="Delete" name="'. htmlspecialchars($row["id"]).'"style="border:none;">
                        </form>';
                        echo htmlspecialchars($row["email"]).'
                    </td>
                </tr>';
            }
        }

        private function showEmailTable($q)
        {
            echo '
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Emails</th>
                        </tr>
                    </thead>
                    <tbody>';
            $this->showEmails($q);
            echo '
                    </tbody>
                </table>
            </body>
            </html>
            ';
        }

        public function output()
        {
            // $this->showPageTop();
            require_once("resultPageTop.html");
            $this->makeEmailButtons();
            $this->showSearchInput();
            $this->showEmailTable($this->model->q);
        }
    }
