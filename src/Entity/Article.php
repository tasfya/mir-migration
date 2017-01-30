<?php
/**
 * Developer: Hamza Betouar
 * DateTime: 1/30/17 10:14 PM
 */

namespace MirMigration\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Book
 * @package MirMigration\Entity
 * @ORM\Entity(repositoryClass="MirMigration\Repository\ArticleRepository")
 * @ORM\Table(name="articles")
 * @Serializer\ExclusionPolicy("all")
 */

class Article
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     **/
    private $id;

    /**
     * @var int
     * @ORM\Column(name="topic", type="integer")
     * @Serializer\Expose()
     **/
    private $topic;

    /**
     * @var int
     * @ORM\Column(name="reader", type="integer")
     * @Serializer\Expose()
     **/
    private $readerId;

    /**
     * @var string
     * @ORM\Column(name="subject", type="string", length=255)
     * @Serializer\Expose()
     **/
    private $subject;

    /**
     * @var string
     * @ORM\Column(name="description", type="text")
     * @Serializer\Expose()
     **/
    private $description;

    /**
     * @var string
     * @ORM\Column(name="text", type="text")
     * @Serializer\Expose()
     **/
    private $text;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="date")
     * @Serializer\Expose()
     **/
    private $date;

    /**
     * @var int
     * @ORM\Column(name="counter", type="integer")
     * @Serializer\Expose()
     **/
    private $counter;

    /**
     * @var Reader
     * @ORM\ManyToOne(targetEntity="\MirMigration\Entity\Reader")
     * @ORM\JoinColumn(name="reader", referencedColumnName="id", nullable=true)
     */
    private $reader;

    /**
     * @var ArticleCategory
     * @ORM\ManyToOne(targetEntity="\MirMigration\Entity\ArticleCategory")
     * @ORM\JoinColumn(name="topic", referencedColumnName="id", nullable=true)
     */
    private $category;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTopic(): int
    {
        return $this->topic;
    }

    /**
     * @param int $topic
     * @return Article
     */
    public function setTopic(int $topic): Article
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @return int
     */
    public function getReaderId(): int
    {
        return $this->readerId;
    }

    /**
     * @param int $readerId
     * @return Article
     */
    public function setReaderId(int $readerId): Article
    {
        $this->readerId = $readerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Article
     */
    public function setSubject(string $subject): Article
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Article
     */
    public function setDescription(string $description): Article
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Article
     */
    public function setText(string $text): Article
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Article
     */
    public function setDate(\DateTime $date): Article
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getCounter(): int
    {
        return $this->counter;
    }

    /**
     * @param int $counter
     * @return Article
     */
    public function setCounter(int $counter): Article
    {
        $this->counter = $counter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReader()
    {
        return $this->reader;
    }

    /**
     * @param mixed $reader
     * @return Article
     */
    public function setReader($reader)
    {
        $this->reader = $reader;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return Article
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function check(){
        if( in_array($this->topic, [0] ) )
            $this->category = null;
        else
            $this->getCategory()->check();
        if( in_array($this->readerId, [0] ) )
            $this->reader = null;
    }

    /**
     * @Serializer\VirtualProperty()
     */
    public function getScholarId(){
        return $this->getReader()->getScholarId();
    }

    /**
     * @Serializer\VirtualProperty()
     */
    public function getCategoryId(){
        return $this->getCategory()->getId();
    }
}