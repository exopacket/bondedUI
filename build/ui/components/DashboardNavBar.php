<?php

class ClientInterface {

    private $scripts = array();
    private $dataVar = "let data = []";

    public function javascript($functionName, $code) {

        $function = new JsFunction($functionName, $code);
        $function->setTypes(script_t::GLOBAL_FUNCTION, load_t::AFTER_BODY, return_t::WITH_OUT);
        Bond::getHandler()::addObject($function);

    }

    public function update($component, $children) {

        Bond::getHandler()::addObject(new JsUpdateWindow($component, $children));

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

    protected function getClassname(){
        return get_class(self::class);
    }

    protected function template() {

        /*

            #title (HTML element id)
            @increment (Event listener name) ** must be used with HTML element ids or # **
            $table (Child component name/definition)
            ?default-table (default value for child component) ** must be used with component names ($) **
            :dark (conditional css class defined in Application PHP class) ** must be used with HTML element ids or # **
            data.counter (without any starting special character will be recognized as data input)

         */

        return '<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
                  <a {{ #company-title :evenodd }} class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6">TEST {{ data.counter }}</a>
                  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  {{ $search-bar-child ?search-bar }}
                  <div class="navbar-nav">
                    <div class="nav-item text-nowrap">
                      <a {{ #increment-btn @increment }} class="nav-link px-3">Sign out</a>
                    </div>
                  </div>
                </header>';

    }

    /*

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

    */

}