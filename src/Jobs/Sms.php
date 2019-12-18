<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class Sms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $number;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($number, $message)
    {
        $this->number = $number;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ch = curl_init();
        $data = "{
            \"sendSmsRequest\": {
            \"to\": \"". $this->number ."\",
            \"msg\": \"". $this->message ."\",
            \"aggregateId\": \"".config('services.zenvia.aggregateId')."\"
            }
        }";
        curl_setopt($ch, CURLOPT_URL, "https://api-rest.zenvia.com/services/send-sms");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Authorization: Basic {credenciais em base 64 no formato usuário:senha}
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            // "Authorization: Basic cG9wYXBwcy5hcGkyOmZtWjFaMXVt",
            // "Authorization: Basic cG9wYXBwcy5hcGk6b2RWZ0ZGTllLZg==",
            "Authorization: Basic ".base64_encode(config('services.zenvia.conta').':'.config('services.zenvia.senha')),
            "Accept: application/json"
        ));
        
        $response = json_decode(json_encode(curl_exec($ch)), True);
        curl_close($ch);

        if (
            is_array($response) && isset($response['sendSmsResponse']) && 
            isset($response['sendSmsResponse']['statusDescription']) && 
            $response['sendSmsResponse']['statusDescription']!='Ok'
        ) {
            Log::critical(
                '[Sms Job] Erro -> Data: '.$data.' Resposta: '. print_r($response, true)
            );
        }


        return true;
    }
}
