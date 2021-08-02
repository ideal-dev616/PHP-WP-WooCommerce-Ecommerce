<?php
/*
 * Envato API PHP Class
 *
 */

class LiquidEnvato {

    // API settings
    private $api_old_url = 'https://api.envato.com/v1/market';
    public $api_new_url = 'http://api.liquid-themes.com/';

    private $api_new_features = array('author', 'buyer');

    // User credentials
    private $api_key;

    // Return type
    private $responseType = 'object';

    # Constructor
    public function __construct() {

    }
    public function Envato($api_key) {

        // Initialize
        $this->api_key = $api_key;
    }

    public function login_url() {
        return $this->api_new_url.'?request&from='.get_site_url().'&redirect='.self::getUrl();
    }

    private function getUrl() {

		$url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        return $url;

    }

    /**
     * Verify the api credentials and unlock set status
     */
    public function verify_credentials() {

        $response = $this->call('/total-items.json');

        return ( ! isset( $response->error ) && ! isset( $response['error'] ) ) ? true : false;
    }

    /**
     * Set response types
     *
     * @param string $type The type of response, values: array & object (default)
     */
    public function set_response_type( $type ) {

        if ( 'array' === $type )
            $this->responseType = 'array';
    }

    /**
     * Preparing the api call by automatically selecting the correct API version and adding the set
     *
     * @param string $set The url parameters without the basic api url
     * @return mixed The response as object or transformed into an array
     */
    public function call( $set )
    {
        $url = $this->api_new_url;


        $url .= $set;

        // Fetch data
        $response = self::curl($url);

        // Handle return types
        if ( 'array' === $this->responseType )
            return self::object_to_array( $response );

        // Also returning possible error object/array including the attributes "error" (code) and "description" (message)
        return $response;
    }

    /**
     * General purpose function to query the Envato API.
     *
     * @param string $url The url to access, via curl.
     * @return object The results of the curl request.
     */
    public function curl($url, $arge = array())
    {
        $cookies = array();
        $theme = wp_get_theme();
        //$theme_name = $theme->get('Name');
        $theme_name = 'Ave';
        $cookies[] = new WP_Http_Cookie( array( 'name' => 'active_theme', 'value' => $theme_name ) );

        $defaults = array(
            'cookies' => $cookies
        );

            $args = wp_parse_args( $arge, $defaults );

            // Make an API request.
            $response = wp_remote_get( esc_url_raw( $url ), $args );
            
            // Check the response code.
            $response_code    = wp_remote_retrieve_response_code( $response );
            $response_message = wp_remote_retrieve_response_message( $response );
            
            if(is_array($response) && isset($response['body'])) {
                return wp_remote_retrieve_body($response);
            } else {
                return new WP_Error( $response_code, __( 'An unknown API error occurred.', 'ave-core' ) );
            }
    }

    /*
     * Object to Array
     */
    protected function object_to_array($object) {
        return json_decode(json_encode($object), true);
    }

    /*
     * Debugging
     */
    protected function debug($args) {
        echo '<pre>';
        print_r($args);
        echo '</pre>';
    }
}