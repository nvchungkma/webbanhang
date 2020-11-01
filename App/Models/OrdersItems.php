<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrdersItems
 *
 * @ORM\Table(name="orders_items", indexes={@ORM\Index(name="fk_orders_items_items", columns={"item_id"}), @ORM\Index(name="fk_orders_items_orders", columns={"order_id"})})
 * @ORM\Entity
 */
class OrdersItems
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
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="applied_price", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $appliedPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="base_price", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $basePrice;

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
     * @var Orders
     *
     * @ORM\ManyToOne(targetEntity="Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     * })
     */
    private $order;

    /**
     * OrdersItems constructor.
     * @param int $quantity
     * @param string $appliedPrice
     * @param string $basePrice
     * @param Items $item
     * @param Orders $order
     */
    public function __construct(int $quantity, string $appliedPrice, string $basePrice, Items $item, Orders $order)
    {
        $this->quantity = $quantity;
        $this->appliedPrice = $appliedPrice;
        $this->basePrice = $basePrice;
        $this->item = $item;
        $this->order = $order;
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
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getAppliedPrice(): string
    {
        return $this->appliedPrice;
    }

    /**
     * @param string $appliedPrice
     */
    public function setAppliedPrice(string $appliedPrice): void
    {
        $this->appliedPrice = $appliedPrice;
    }

    /**
     * @return string
     */
    public function getBasePrice(): string
    {
        return $this->basePrice;
    }

    /**
     * @param string $basePrice
     */
    public function setBasePrice(string $basePrice): void
    {
        $this->basePrice = $basePrice;
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
     * @return Orders
     */
    public function getOrder(): Orders
    {
        return $this->order;
    }

    /**
     * @param Orders $order
     */
    public function setOrder(Orders $order): void
    {
        $this->order = $order;
    }


}
