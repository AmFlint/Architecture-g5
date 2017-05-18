<?php
/**
 * Created by PhpStorm.
 * User: antoinemasselot
 * Date: 18/05/2017
 * Time: 00:29
 */

namespace Model;


use classes\Model;

class APIModel extends Model
{
    public function getMagazines($location)
    {
        $row = $this->qb
            ->table('magazines')
            ->select(array(
                'magazines.id',
                'magazines.title',
                'magazines.image',
                'magazines.date',
                'magazines.location_id',
                'magazines.secondary_location',
                'l1.location as location',
                'l2.location as secondary_location'))
            ->join('location as l1', 'inner')
            ->on('magazines.location_id', 'l1.id')
            ->join('location as l2', 'inner')
            ->on('magazines.secondary_location', 'l2.id')
            ->where('l1.location', $location)
            ->where('l2.location', $location, ' OR ')
            ->limit(12)
            ->get();
        return $row;
    }

    public function addPartnership($mag_id, $partner_id)
    {
        $this->qb
            ->addColumns([
                'partenaire_id',
                'magazine_id'
            ])
            ->values([
                $partner_id,
                $mag_id
            ])
            ->table('partenariat')
            ->add();
    }
}