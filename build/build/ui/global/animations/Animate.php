<?php

class Animate {
    use Fade;

    public function animate(Animation $type, JsComponent $component) {
        call_user_func(array($this, $type), $component);
    }

}

?>