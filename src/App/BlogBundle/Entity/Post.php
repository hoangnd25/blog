<?php

namespace App\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Cmf\Bundle\SeoBundle\Model\SeoMetadataInterface;
use Symfony\Cmf\Bundle\SeoBundle\SeoAwareInterface;
use Symfony\Cmf\Bundle\SeoBundle\Extractor\DescriptionReadInterface;
use Symfony\Cmf\Bundle\SeoBundle\Extractor\ExtrasReadInterface;
use Symfony\Cmf\Bundle\SeoBundle\Extractor\KeywordsReadInterface;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity
 */
class Post implements SeoAwareInterface, DescriptionReadInterface, ExtrasReadInterface, KeywordsReadInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=200)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=255, unique=true, nullable= true))
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="text", nullable= true)
     */
    private $intro;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="posts",cascade={"persist","remove"})
     */
    private $tags;

    /**
     * @ORM\Column(type="boolean", nullable= true)
     */
    private $published;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable= true)
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable= true)
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="object", nullable= true)
     */
    protected $seoMetadata;

    function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->setPublished(false);
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
     * Set title
     *
     * @param string $title
     * @return Post
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
     * Set body
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $intro
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
    }

    /**
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param mixed $tag
     */
    public function addTag($tag)
    {
        $this->tags->add($tag);
        $tag->getPosts()->add($this);
    }

    /**
     * @param mixed $tag
     */
    public function removeTag($tag)
    {
        $this->tags->removeElement($tag);
        $tag->getPosts()->removeElement($this);
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param \datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return \datetime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Gets the SEO metadata for this content.
     *
     * @return SeoMetadataInterface
     */
    public function getSeoMetadata()
    {
        return $this->seoMetadata;
    }

    /**
     * Sets the SEO metadata for this content.
     *
     * This method is used by a listener, which converts the metadata to a
     * plain array in order to persist it and converts it back when the content
     * is fetched.
     *
     * @param array|SeoMetadataInterface $metadata
     */
    public function setSeoMetadata($metadata)
    {
        $this->seoMetadata = $metadata;
    }

    /**
     * Provide a description of this page to be used in SEO context.
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->getIntro();
    }

    /**
     * Provides a list of extras as key-values pairs
     * for this page's SEO context and meta type property.
     *
     * Different types should be grouped in different arrays.
     *
     * Example return:
     *  array(
     *       'property'   => array('og:title' => 'Extra Title'),
     *       'name'       => array('robots' => 'index, follow'),
     *       'http-equiv' => array('Content-Type' => 'text/html; charset=utf-8'),
     *   )
     *
     * @return array
     */
    public function getSeoExtras()
    {
        return array(
            'property' => array(
                'og:title'       => $this->title,
                'og:description' => $this->intro,
            ),
        );
    }


    /**
     * Provides a list of keywords for this page to be
     * used in SEO context.
     *
     * @return string|array
     */
    public function getSeoKeywords()
    {
        $keywords = array();
            foreach ($this->getTags() as $tag){
                $keywords[] = $tag->getName();
            }
        return  $keywords;
    }

    function __toString()
    {
        return $this->getTitle();
    }


}
