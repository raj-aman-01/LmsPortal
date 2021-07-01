<?php
namespace Ari_Stream_Quiz\Controllers\Quiz_Session;

use Ari\Controllers\Ajax as Ajax_Controller;
use Ari\Utils\Request as Request;
use Ari_Stream_Quiz\Helpers\Settings as Settings;

class Ajax_Collect_Data extends Ajax_Controller {
    protected function process_request() {
        $quiz_id = Request::get_var( 'id', 0, 'num' );
        if ( $quiz_id < 1 )
            return false;

        $quiz_model = $this->model( 'Quiz' );
        $quiz = $quiz_model->get_quiz( $quiz_id );

        if ( is_null( $quiz ) ) {
            return false;
        }

        $user_data = stripslashes_deep( Request::get_var( 'user_data' ) );
        $user_data = json_decode( $user_data, true );

        $result = true;

        if ( $quiz->quiz_meta->mailchimp->enabled && ! empty( $quiz->quiz_meta->mailchimp->list_id ) ) {
            if ( ! $this->add_to_mailchimp_list( $user_data, $quiz->quiz_meta->mailchimp->list_id ) )
                $result = false;
        }

        if ( $quiz->quiz_meta->mailerlite->enabled && ! empty( $quiz->quiz_meta->mailerlite->list_id ) ) {
            if ( ! $this->add_to_mailerlite_list( $user_data, $quiz->quiz_meta->mailerlite->list_id ) )
                $result = false;
        }

        return $result;
    }

    private function add_to_mailchimp_list( $data, $list_id ) {
        $email = isset( $data['email'] ) ? $data['email'] : '';
        $api_key = Settings::get_option( 'mailchimp_apikey' );

        if ( empty( $email ) || empty( $api_key ) )
            return false;

        $name = isset( $data['name'] ) ? $data['name'] : '';

        require_once ARISTREAMQUIZ_3RDPARTY_LOADER;

        try {
            $mailchimp = new \DrewM\MailChimp\MailChimp( $api_key );

            $result = $mailchimp->post(
                'lists/' . $list_id . '/members',

                array(
                    'email_address' => $email,

                    'status' => 'subscribed',

                    'merge_fields' => array(
                        'FNAME' => $name,
                    ),
                )
            );
        } catch (\Exception $ex) {
            $result = false;
        }

        return $result;
    }

    private function add_to_mailerlite_list( $data, $list_id ) {
        $email = isset( $data['email'] ) ? $data['email'] : '';
        $api_key = Settings::get_option( 'mailerlite_apikey' );

        if ( empty( $email ) || empty( $api_key ) )
            return false;

        $name = isset( $data['name'] ) ? $data['name'] : '';

        require_once ARISTREAMQUIZ_3RDPARTY_LOADER;

        try {
            $groups_api = ( new \MailerLiteApi\MailerLite( $api_key ) )->groups();
            $subscriber = $groups_api->addSubscriber(
                $list_id,

                array(
                    'email' => $email,

                    'name' => $name,
                )
            );
        } catch (\Exception $ex) {
            $result = false;
        }

        return $result;
    }
}
