<?php
class Flash {

    public static function flashWithRedirect($message, $type, $route) 
    {
        $typeFlash = array(
            'success' => array(
                'color' => 'success'
            ),
            'error' => array(
                'color' => 'danger'
            ),
            'warning' => array(
                'color' => 'warning'
            )
        );

        $_SESSION['flashMessage'] = array(
            'text' => $message,
            'type' => $type,
            'class' => $typeFlash[$type]['color']
        );
        header("Location: index.php?$route");
        exit();
    }
}