<?php

class Dialogue
{
    private $message = '';
    private $type = 'info';
    private $messages;

    public function appendMessage($msg, $type)
    {
        if (!isset($this->messages)) {
            $this->messages = array(array($type, $msg));
        } else {
            array_push($this->messages, array($type, $msg));
        }
    }

    public function setMessageType($t)
    {
        $this->type = $t;
    }

    public function printDialogueBox()
    {
        $rand = new RandomInfo();
        $head = $rand->generateTip($this->type);
        if ($this->type == 'error') {
            echo '<div class="panel panel-danger">';
        } elseif ($this->type == 'success') {
            echo '<div class="panel panel-success">';
        } elseif ($this->type == 'info') {
            echo '<div class="panel panel-info">';
        } else {
            echo '<div class="panel panel-default">';
        }
        echo '<div class="panel-heading">'.$head.'</div>';
        echo '<div class="panel-body">'.$this->message.'</div>';
        echo '</div>';
    }

    public function printAlerts()
    {
        $rand = new RandomInfo();
        if (isset($this->messages)) {
            foreach ($this->messages as $alert) {
                $type = $alert[0];
                $msg = $alert[1];

                if ($type == 'error') {
                    echo '<div class="alert alert-danger">';
                } elseif ($type == 'success') {
                    echo '<div class="alert alert-success">';
                } elseif ($type == 'info') {
                    echo '<div class="alert alert-info">';
                } else {
                    echo '<div class="panel panel-default">';
                }
                $tip = $rand->generateTip($type);
                echo "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
                echo "<strong>$tip</strong>  ".$msg;
                echo '</div>';

                $head = $rand->generateTip($this->type);
            }
        }
    }
}
