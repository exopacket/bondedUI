<?php

class ClientInterface {

    private $scripts = array();
    private $dataVar = "let data = []";

    public function javascript($functionName, $code) {

        return new JsFunction($functionName, $code);

    }

    public function update($component, $children) {

        return new JsUpdateWindow($component, $children);

    }

    public function changePage($page) {



    }

    public function setListeners($listeners) {

    }

    public function delayed() {

    }

    public function location($page) {

    }

    public function animate($element, $animation, ...$params) {

    }

    public function initialize() {

    }

    public function setVariables($data) {

        if($data instanceof Script) {

            $this->dataVar = "let data = " . json_encode($data) . ";";

        } else if(is_array($data)) {

        } else if(is_string($data)) {

        } // ....

    }

    public function getVariables() {
        return $this->dataVar;
    }

}

class ApiInterface {

    public function call($resource, ...$params) {



    }

    public function fetch($resource, ...$params) {



    }

}

class DashboardNavBar extends Mountable {

    public function __construct(...$params) {
        parent::__construct($params);
    }



    /*
     *
     *
     *
     *
     *
     function data() {
           return $api->call->getUserData();
     }
     function goHomeHandler() {
        //generates javascript with history API and dynamic load
        $client->loadPage("index.php");
     }
     function signOutHandler() {
        //generates javascript
        $api->fetch->signOut(); //client calls ajax / api
        $api->call->signOut(); //alternative per page; client calls current page with task; returns as api
     }
     function incrementHandler() {

            $client->javascript('
                data.counter++;
            ');

     }
     */

    protected function getClassname(){
        return get_class(self::class);
    }

    protected function template() {

        return '<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
                  <a {{ #company-title }} class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6">TEST #{{ data.counter }}</a>
                  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search">
                  <div class="navbar-nav">
                    <div class="nav-item text-nowrap">
                      <a {{ #increment-btn @increment }} class="nav-link px-3">Sign out</a>
                    </div>
                  </div>
                </header>';

    }
}