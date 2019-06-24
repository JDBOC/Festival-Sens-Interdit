<?php

namespace App\Service;

class Footer
{

    public function footer()
    {
        $contactForm = $this->createForm(ContactType::class);

        return $contactForm;
    }

        public function language()
        {
            $language = $_SESSIONS['language'] = 'fr';

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST))
            {
                if ($_POST['language'] == "en_EN") 
                {
                    $language =  $_POST['language'];
                }
            }
            return $language;
        }
            
}