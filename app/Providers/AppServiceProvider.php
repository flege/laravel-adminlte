<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        function generateDatatableColumn($array) {
            $response = array();
            foreach ($array as $d){
                if(is_array($d)){
                    array_push($response,array(
                        'data' => $d[0],
                        'searchable' => $d[1],
                        'orderable' => $d[1],
                    ));
                }else{
                    array_push($response,array('data' => $d));
                }
            }
            return json_encode($response);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
