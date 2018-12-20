<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="biography", type="text", nullable=true)
     */
    private $biography;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateJoined", type="datetime")
     */
    private $dateJoined;

    /**
     * @var string
     * @ORM\Column(name="favoriteTopics", type="string", length=255, nullable=true)
     */
    private $favoriteTopics;

    /**
     * @var string
     * @ORM\Column(name="profileImg", type="string", length=255, nullable=true)
     */
    private $profileImg;

    /**
     * User constructor.
     * @param ArrayCollection $post
     * @param ArrayCollection $comment
     * @param ArrayCollection $roles
     */
    public function __construct(ArrayCollection $post, ArrayCollection $comment, ArrayCollection $roles)
    {
        $this->post = $post;
        $this->comment = $comment;
        $this->roles = $roles;
    }

    /**
     * @return ArrayCollection
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param ArrayCollection $post
     * @return User
     */
    public function setPost(Post $post)
    {
        $this->posts[] = $post;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param ArrayCollection $comment
     * @return User
     */
    public function setComment(Comment $comment)
    {
        $this->comment[] = $comment;
        return $this;
    }

    /**
     * @return (Role|string)[]
     */
    public function getRoles()
    {
        /**
         * @var $role Role
         */
        $stringRoles=[];
        foreach ($this->roles as $role){
            $stringRoles[]=$role->getRole();
        }

        return['ROLE_USER'];
    }

    /**
     * @param ArrayCollection $roles
     * @return User
     */
    public function setRoles(Role $role)
    {
        $this->roles[]=$role;
        return $this;
    }
    /**
     * @param Post $post
     * @return bool
     */
    public function isPostAuthor(Post $post){
        return $post->getAuthorId()==$this->getId();

    }
    /**
     * @param Post $post
     * @return bool
     */
    public function isCommentAuthor(Comment $comment){
        return $comment->getAuthorId()==$this->getId();

    }

    /**
     * @return bool
     */
    public function isAdmin(){
        return in_array("ROLE_ADMIN",$this->getRoles());
    }
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Post",mappedBy="author")
     */
    private $post;
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="author")
     */
    private $comment;
    /**
     * @var ArrayCollection
     *
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role")
     * @ORM\JoinTable(name="users_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
     */
    private $roles;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set biography
     *
     * @param string $biography
     *
     * @return User
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set dateJoined
     *
     * @param \DateTime $dateJoined
     *
     * @return User
     */
    public function setDateJoined($dateJoined)
    {
        $this->dateJoined = $dateJoined;

        return $this;
    }

    /**
     * Get dateJoined
     *
     * @return \DateTime
     */
    public function getDateJoined()
    {
        return $this->dateJoined;
    }

    /**
     * Set favoriteTopics
     *
     * @param string $favoriteTopics
     *
     * @return User
     */
    public function setFavoriteTopics($favoriteTopics)
    {
        $this->favoriteTopics = $favoriteTopics;

        return $this;
    }

    /**
     * Get favoriteTopics
     *
     * @return string
     */
    public function getFavoriteTopics()
    {
        return $this->favoriteTopics;
    }

    /**
     * Set profileImg
     *
     * @param string $profileImg
     *
     * @return User
     */
    public function setProfileImg($profileImg)
    {
        $this->profileImg = $profileImg;

        return $this;
    }

    /**
     * Get profileImg
     *
     * @return string
     */
    public function getProfileImg()
    {
        return $this->profileImg;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}

