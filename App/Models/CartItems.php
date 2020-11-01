<?php


namespace App\Models;
use Doctrine\ORM\Mapping as ORM;

/**
 * CartItems
 *
 * @ORM\Table(name="cart_items", indexes={@ORM\Index(name="fk_cart_items_items", columns={"item_id"}), @ORM\Index(name="fk_cart_items_users", columns={"user_id"})})
 * @ORM\Entity
 */
class CartItems
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var Items
     *
     * @ORM\ManyToOne(targetEntity="Items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * })
     */
    private $item;

    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * CartItems constructor.
     * @param int $id
     * @param int|null $quantity
     * @param Items $item
     * @param Users $user
     */
    public function __construct(Items $item, Users $user)
    {
        $this->quantity = 1;
        $this->item = $item;
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return Items
     */
    public function getItem(): Items
    {
        return $this->item;
    }

    /**
     * @param Items $item
     */
    public function setItem(Items $item): void
    {
        $this->item = $item;
    }

    /**
     * @return Users
     */
    public function getUser(): Users
    {
        return $this->user;
    }

    /**
     * @param Users $user
     */
    public function setUser(Users $user): void
    {
        $this->user = $user;
    }


}
