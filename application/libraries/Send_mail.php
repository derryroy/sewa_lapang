<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Send_mail
{

    public function sendinblue($subject, $email, $message, $date = '')
    {
        include_once APPPATH . "../vendor/autoload.php";

        $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_KEY);

        $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
            new GuzzleHttp\Client(),
            $config
        );
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = $subject;
        $sendSmtpEmail['htmlContent'] = $message;
        $sendSmtpEmail['sender'] = array('name' => 'C-tra Arena', 'email' => 'noreply@c-traarena.id');
        $sendSmtpEmail['to'] = array(
            array('email' => $email)
        );

        if ($date) {
            $pdfPath = 'upload/pdf/daily_report_' . $date . '.pdf';
            $content = chunk_split(base64_encode(file_get_contents($pdfPath)));
            $attachment_item = array(
                'name' => 'daily_report_' . $date . '.pdf',
                'content' => $content
            );
            $attachment_list = array($attachment_item);
            $sendSmtpEmail['attachment'] = $attachment_list;
        }

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            return $result;
        } catch (Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }
}
