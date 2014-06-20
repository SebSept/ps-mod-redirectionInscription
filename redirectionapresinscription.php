<?php

/**
 * RedirectionApresInscription
 *
 * Rédirige l'utilisateur qui vient de s'inscrire vers une page CMS.
 * 
 * @author Sébastien Monterisi http://seb7.fr/
 * @generator http://prestashop.seb7.fr/prestashop-module-builder/
 **/
if (!defined('_PS_VERSION_'))
    exit;

class RedirectionApresInscription extends Module
{

    /**
     * @var id_page_cms
     * identifiant de la page CMS vers laquelle rediriger
     */
    protected $id_page_cms = 1;
    
    public function __construct()
    {
        $this->name = 'redirectionapresinscription';
        $this->tab = 'custom';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Redirection après inscription');
        $this->description = $this->l('Rédirige l utilisateur qui vient de s&#039;inscrire vers une page CMS.');

        $this->version = '0.1';
        $this->author = 'seb7.fr';
    }

    /**
     * @return bool success
     * */
    public function install()
    {
        return parent::install() 
                && $this->registerHook('actionCustomerAccountAdd');
    }

    /**
     * hookActionCustomerAccountAdd
     *
     * Successful customer create account
     * Called when new customer create account successfuled
     * 
     * Modifie la variable $_POST['back'] : 
     * permet la redirection apres inscription via AuthController
     **/
    public function hookActionCustomerAccountAdd($params)
    {
        $link = new Link();
        $_POST['back'] = htmlentities( $link->getCMSLink($this->id_page_cms) );
        
        Logger::addLog($this->name.' : Redirection vers '.$_POST['back'],  1, null, null, $this->id_page_cms, true);
    }

}
