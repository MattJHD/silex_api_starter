<?php

namespace Model;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\Type;

/**
 * User.
 *
 * @Hateoas\Relation("self", href = @Hateoas\Route("user_get", parameters = {"id" = "expr(object.getId())"}))
 */
class User
{
    /**
     * @var int
     * @Type("int")
     */
    private $id;

//    /**
//     * @var string
//     */
//    private $firstName;
//
//    /**
//     * @var string
//     */
//    private $lastName;
    
    /////////////acl-yacast-4/////////////
    
    /**
     * @var string
     * @Type("string")
     */
    private $title;
    
    /**
     * @var string
     * @Type("string")
     */
    private $login;
    
    /**
     * @var int
     * @Type("int")
     */
    private $is_group;
    
    /**
     * @var int
     * @Type("Model\User")
     */
    private $parent_id = null;

    /**
     * Constructor.
     *
     * @param int $id (default null)
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * Fill an object from a data array.
     * @param  array  $data data about object (i.e. database)
     * @return User       curent object
     */
    public function fill(array $data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
//        $this->firstName = isset($data['firstName']) ? $data['firstName'] : null;
//        $this->lastName = isset($data['lastName']) ? $data['lastName'] : null;
        
        $this->title = isset($data['title']) ? $data['title'] : null; 
        $this->login = isset($data['login']) ? $data['login'] : null;
        $this->is_group = isset($data['is_group']) ? $data['is_group'] : null;
        //$this->parent_id = isset($data['parent_id']) ? $data['parent_id'] : null;

        return $this;
    }
    
    //getters
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getIs_group() {
        return $this->is_group;
    }

    public function getParent_id() {
        return $this->parent_id;
    }

    //setters
    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setIs_group($is_group) {
        $this->is_group = $is_group;
    }

    function setParent_id($parent_id) {
        $this->parent_id = $parent_id;
    }


}
