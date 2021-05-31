<?php

namespace SubmittedEmails;

class View
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
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
        require_once("emailsPageTop.html");
        $this->makeEmailButtons();
        $this->showSearchInput();
        $this->showEmailTable($this->model->q);
    }
}
