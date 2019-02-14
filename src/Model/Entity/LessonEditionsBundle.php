<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LessonEditionsBundle Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $lesson_edition_count
 * @property bool $is_active
 * @property float $price
 * @property int $lesson_id
 *
 * @property \App\Model\Entity\PurchasedLessonEditionsBundle[] $purchased_lesson_editions_bundles
 */
class LessonEditionsBundle extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'description' => true,
        'lesson_edition_count' => true,
        'is_active' => true,
        'price' => true,
        'lesson_id' => true,
        'purchased_lesson_editions_bundles' => true
    ];
}
