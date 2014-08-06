<?php
/**
 * Created by PhpStorm.
 * User: Matrix
 * Date: 04.08.14
 * Time: 11:40
 */

/**
 * Class Topic
 * @Entity(repositoryClass="TopicRepository")
 * @Table(name="topics")
 */
class Topic {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $title;

    /**
     * @Column(type="string")
     */
    private $message;

    /** @Column(type="datetime") */
    private $date_created;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="creator", referencedColumnName="id")
     */
    private $creator;

    /**
     * @Column(type="string")
     */
    private $picture;

    /**
     * @Column(type="boolean")
     */
    private $deleted = false;

    /**
     * @OneToMany(targetEntity="Comment", mappedBy="topic")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $comments;

    /**
     * @OneToMany(targetEntity="Vote", mappedBy="topic")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $votes;

    /**
     * @var float
     */
    private $mark = 0;

    /**
     * @param float $mark
     */
    public function setMark($mark)
    {
        $this->mark = $mark;
    }

    /**
     * @return float
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date_created
     *
     * @param \DateTime $dateCreated
     * @return Topic
     */
    public function setDateCreated($dateCreated)
    {
        $this->date_created = $dateCreated;

        return $this;
    }

    /**
     * Get date_created
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Set creator
     *
     * @param \User $creator
     * @return Topic
     */
    public function setCreator(\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \User 
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Topic
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Topic
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Topic
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Topic
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comments
     *
     * @param \Comment $comments
     * @return Topic
     */
    public function addComment(\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Comment $comments
     */
    public function removeComment(\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add votes
     *
     * @param \Vote $votes
     * @return Topic
     */
    public function addVote(\Vote $votes)
    {
        $this->votes[] = $votes;

        return $this;
    }

    /**
     * Remove votes
     *
     * @param \Vote $votes
     */
    public function removeVote(\Vote $votes)
    {
        $this->votes->removeElement($votes);
    }

    /**
     * Get votes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVotes()
    {
        return $this->votes;
    }

    public function calculateMark(){
        $this->getVotes();
        if($this->votes->count() > 0){
            $total = $this->votes->count();
            $sum = 0;
            foreach($this->votes as $vote){

                $sum += $vote->getMark();
            }

            $this->setMark(round($sum/$total));
        } else {
            $this->mark = 0;
        }

    }
}
