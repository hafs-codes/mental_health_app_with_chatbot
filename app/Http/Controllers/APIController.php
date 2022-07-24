<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require 'vendor/autoload.php';

use NLPCloud\NLPCloud;

class APIController extends Controller
{
    //
    function apiexamplepost()
    {
        require 'vendor/autoload.php';

$client = new \NLPCloud\NLPCloud('roberta-base-squad2','403a199d4628b2185f70932f3f2bcbd5d578a2b1');
# Returns a json object.
$client->question("When can plans be stopped?",
"All NLP Cloud plans can be stopped anytime. You only pay for the time you used the service. In case of a downgrade, you will get a discount on your next invoice.");

    }
}
