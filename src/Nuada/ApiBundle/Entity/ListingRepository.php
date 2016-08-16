<?php

namespace Nuada\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ListingRepository
 *
 * This class was generated by the Doctrine ORM. 
 */
class ListingRepository extends EntityRepository
{
	/**
     * Retrieve All
     *
     * @param integer $id          - Listing Id
     * @param integer $limit       - Limit
     * @param integer $offset      - Offset
     * @param boolean $withDeleted - With deleted listing
     * @param integer $city        - City
     * @param integer $community   - Community
     * @param integer $category    - category
     * @param boolean $subcategory - Sub category
     * @param integer $type        - Type
     * @param integer $agencyId    - Agency Id
     * @param integer $bed         - bed
     * @param integer $minPrice    - Min Price
     * @param integer $maxPrice    - Max Price
     * @param integer $minArea     - Min Area
     * @param boolean $maxArea     - Max Area
     * @param boolean $furnishing  - Furnishing
     * @param boolean $agentId     - Agent Id
     *
     * @return array
     */
    public function retrieveAll($id = null, $limit = null, $offset = null, $withDeleted = false, $search = null,
        $city = null, $community = null, $category = null, $subcategory = null, $type = null, $agencyId = null, 
        $bed = null, $minPrice = null, $maxPrice = null, $minArea = null, $maxArea = null, 
        $furnishing = null, $agentId = null, $sortOn = null, $reverse = false, $frequency = null)
    {
    	if (!is_null($id)) {
        	return $this->find($id);
        }

        $qb = $this->createQueryBuilder('e');

        if (!is_null($search)) {
            $qb = $qb->AndWhere('e.city = :search')
                     ->orWhere('e.community = :search')
                     ->orWhere('e.subCommunity = :search')
                     ->orWhere('e.tower = :search')
                     ->orWhere('e.agencyName = :search')
                     ->setParameter('search', $search);
        }

        if (!is_null($city)) {
            $qb = $qb->andWhere('e.city = :city')
                     ->setParameter('city', $city);
        }
        if (!is_null($community)) {
            $qb = $qb->andWhere('e.community = :community')
                     ->setParameter('community', $community);
        }
        if (!is_null($category)) {
            $qb = $qb->andWhere('e.listingCategory = :category')
                     ->setParameter('category', $category);
        }
        if (!is_null($subcategory)) {
            $qb = $qb->andWhere('e.listingSubCategory = :subcategory')
                     ->setParameter('subcategory', $subcategory);
        }
        if (!is_null($type)) {
            $qb = $qb->andWhere('e.listingType in (:type)')
                     ->setParameter('type', $type);
        }
        if (!is_null($agencyId)) {
             $qb = $qb->andWhere('e.agencyId = :agencyId')
                      ->setParameter('agencyId', $agencyId);
        }
        if (!is_null($bed)) {
            $qb = $qb->andWhere('e.bedroom in (:bed)')
                     ->setParameter('bed', $bed);
        }
        if (!is_null($minPrice)) {
            $qb = $qb->andWhere('e.price >= :minPrice')
                     ->setParameter('minPrice', $minPrice);
        }
        if (!is_null($maxPrice)) {
            $qb = $qb->andWhere('e.price <= :maxPrice')
                     ->setParameter('maxPrice', $maxPrice);
        }
        if (!is_null($minArea)) {
            $qb = $qb->andWhere('e.sqft >= :minArea')
                     ->setParameter('minArea', $minArea);
        }
        if (!is_null($maxArea)) {
            $qb = $qb->andWhere('e.sqft <= :maxArea')
                     ->setParameter('maxArea', $maxArea);
        }
        if (!is_null($agentId)) {
            $qb = $qb->andWhere('e.agentId = :agentId')
                     ->setParameter('agentId', $agentId);
        }

        if (!is_null($frequency)) {
            $qb = $qb->andWhere('e.frequency = :frequency')
                     ->setParameter('frequency', $frequency);
        }

        if ($sortOn) {
            $order = $this->getSortCriteria($sortOn, $reverse);
            
            $qb->orderBy('e.'.$order['column'], $order['direction']);
        } else {
            $order0['column'] = 'buildYear';
            $order0['direction'] = 'DESC';

            $qb->addOrderBy('e.'.$order0['column'], $order0['direction']);

            $order3['column'] = 'price';
            $order3['direction'] = 'ASC';

            $qb->addOrderBy('e.'.$order3['column'], $order3['direction']);

            $order1['column'] = 'createdOn';
            $order1['direction'] = 'DESC';

            $qb->addOrderBy('e.'.$order1['column'], $order1['direction']);

            $order2['column'] = 'sqft';
            $order2['direction'] = 'DESC';

            $qb->addOrderBy('e.'.$order2['column'], $order2['direction']);
        }
        
        if ($offset) {
            $qb->setMaxResults($limit);
            $qb->setFirstResult($offset);
        }

        if ($limit && !$offset) {
            $qb->setMaxResults($limit);
        }

        $qb =  $qb->AndWhere('e.publishListing = 1');

        $query = $qb->getQuery();


        return $query->getResult();
    }

    /**
     * Retrieve Count
     *
     * @param integer $id          - Listing Id
     * @param boolean $withDeleted - With deleted listing
     * @param integer $city        - City
     * @param integer $community   - Community
     * @param integer $category    - category
     * @param boolean $subcategory - Sub category
     * @param integer $type        - Type
     * @param integer $agencyId    - Agency Id
     * @param integer $bed         - Bed
     * @param integer $minPrice    - Min Price
     * @param integer $maxPrice    - Max Price
     * @param integer $minArea     - Min Area
     * @param boolean $maxArea     - Max Area
     * @param boolean $furnishing  - Furnishing
     * @param boolean $agentId     - Agent Id
     *
     * @return array
     */
    public function fetchCount($id = null, $withDeleted = false, $search = null,
        $city = null, $community = null, $category = null, $subcategory = null, $type = null, $agencyId = null, 
        $bed = null, $minPrice = null, $maxPrice = null, $minArea = null, $maxArea = null, 
        $furnishing = null, $agentId = null, $fromDate = null, $toDate = null, $frequency = null)
    {
        $qb = $this->createQueryBuilder('e')
                    ->select('count(e)');

        if (!is_null($id)) {
            $qb = $qb->AndWhere('e.id = :id')
                    ->setParameter('id', $id);
        }

        if (!is_null($search)) {
            $qb = $qb->AndWhere('e.city = :search')
                     ->orWhere('e.community = :search')
                     ->orWhere('e.subCommunity = :search')
                     ->orWhere('e.tower = :search')
                     ->orWhere('e.agencyName = :search')
                     ->setParameter('search', $search);
        }
        
        if (!is_null($city)) {
            $qb = $qb->andWhere('e.city = :city')
                     ->setParameter('city', $city);
        }
        if (!is_null($community)) {
            $qb = $qb->andWhere('e.community = :community')
                     ->setParameter('community', $community);
        }
        if (!is_null($category)) {
            $qb = $qb->andWhere('e.listingCategory = :category')
                     ->setParameter('category', $category);
        }
        if (!is_null($subcategory)) {
            $qb = $qb->andWhere('e.listingSubCategory = :subcategory')
                     ->setParameter('subcategory', $subcategory);
        }
        if (!is_null($type)) {
            $qb = $qb->andWhere('e.listingType in (:type)')
                     ->setParameter('type', $type);
        }
        if (!is_null($agencyId)) {
             $qb = $qb->andWhere('e.agencyId = :agencyId')
                      ->setParameter('agencyId', $agencyId);
        }
        if (!is_null($bed)) {
            $qb = $qb->andWhere('e.bedroom in  (:bed)')
                     ->setParameter('bed', $bed);
        }
        if (!is_null($minPrice)) {
            $qb = $qb->andWhere('e.price >= :minPrice')
                     ->setParameter('minPrice', $minPrice);
        }
        if (!is_null($maxPrice)) {
            $qb = $qb->andWhere('e.price <= :maxPrice')
                     ->setParameter('maxPrice', $maxPrice);
        }
        if (!is_null($minArea)) {
            $qb = $qb->andWhere('e.sqft >= :minArea')
                     ->setParameter('minArea', $minArea);
        }
        if (!is_null($maxArea)) {
            $qb = $qb->andWhere('e.sqft <= :maxArea')
                     ->setParameter('maxArea', $maxArea);
        }
        if (!is_null($agentId)) {
            $qb = $qb->andWhere('e.agentId = :agentId')
                     ->setParameter('agentId', $agentId);
        }
        if (!is_null($fromDate)) {
            $qb = $qb->andWhere('e.createdOn >= :fromDate')
                     ->setParameter('fromDate', $fromDate);
        }
        if (!is_null($toDate)) {
            $qb = $qb->andWhere('e.createdOn <= :toDate')
                     ->setParameter('toDate', $toDate);
        }
        if (!is_null($frequency)) {

            if ($frequency === 'yearly') {
                $frequency = array('yearly', 'per year');
            } else if ($frequency === 'monthly') {
                $frequency = array('per month');
            } else  {
                $frequency = array($frequency);
            }

            $qb = $qb->andWhere('e.frequency in (:frequency)')
                     ->setParameter('frequency', $frequency);
        }

        $qb =  $qb->AndWhere('e.publishListing = 1');

        $query = $qb->getQuery();


        return $query->getSingleScalarResult();
    }

    public function getUnpublishedCount($agencyId=null) {

        $qb = $this->createQueryBuilder('e')
                    ->select('count(e)')
                    ->where('e.publishListing = 0');

        if (!is_null($agencyId)) {
            $qb = $qb->AndWhere('e.agencyId = :agencyId')
                        ->setParameter('agencyId', $agencyId);
        }

        $query = $qb->getQuery();


        return $query->getSingleScalarResult();

    }

    public function getPublishedCount($agencyId=null) {

       $qb = $this->createQueryBuilder('e')
                    ->select('count(e)')
                    ->where('e.publishListing = 1');

        if (!is_null($agencyId)) {
            $qb = $qb->AndWhere('e.agencyId = :agencyId')
                        ->setParameter('agencyId', $agencyId);
        }

        $query = $qb->getQuery();


        return $query->getSingleScalarResult();

    }

    public function getActiveCount($agencyId=null) {

        $totalListing = $this->fetchCount();
        $unpublished = $this->getUnpublishedCount();

        $qb = $this->createQueryBuilder('e')
                    ->select('count(e)')
                    ->where('e.archived = 1');

        if (!is_null($agencyId)) {
            $qb = $qb->AndWhere('e.agencyId = :agencyId')
                        ->setParameter('agencyId', $agencyId);
        }

        $query = $qb->getQuery();

        $archived = $query->getSingleScalarResult();

        return ($totalListing - $unpublished - $archived);

    }


     /**
     * @param string  $sortOn  - Sort field
     * @param boolean $reverse - Sort in reverse
     *
     * @return array
     */
    public function getSortCriteria($sortOn, $reverse)
    {
        if (empty($sortOn)) {
            return array();
        }
        $sort = array();
        $sort['direction'] = $reverse?'DESC':'ASC';

        if ($sortOn == 'modified_on') {
            $sort['column'] = 'modifiedOn';
        }
        else if ($sortOn == 'price') {
            $sort['column'] = 'price';
        }
        else if ($sortOn == 'area') {
            $sort['column'] = 'sqft';
        }
        else if ($sortOn == 'build_year') {
            $sort['column'] = 'buildYear';
        }
        else if ($sortOn == 'floor') {
            $sort['column'] = 'floor';
        }
        else if ($sortOn == 'bedroom') {
            $sort['column'] = 'bedroom';
        }
        else if ($sortOn == 'last_viewed') {
            $sort['column'] = 'lastViewed';
        }
        else if ($sortOn == 'created_on') {
            $sort['column'] = 'createdOn';
        }

        return $sort;
    }

    /**
     * Retrieve Sold Count
     *
     * @param integer $agencyId    - Agency Id
     *
     * @return array
     */
    public function fetchSoldCount($agencyId=null, $search=null)
    {
        $qb = $this->createQueryBuilder('e')
            ->select('count(e)');

        if (!is_null($agencyId)) {
            $qb = $qb->andWhere('e.agencyId = :agencyId')
                ->setParameter('agencyId', $agencyId);
        }
        if (!is_null($search)) {
            $qb = $qb->orWhere('e.city = :search')
                     ->orWhere('e.community = :search')
                     ->orWhere('e.subCommunity = :search')
                     ->orWhere('e.tower = :search')
                     ->orWhere('e.agencyName = :search')
                     ->setParameter('search', $search);
        }

        $qb = $qb->andWhere('e.archived = 1');

        $qb =  $qb->AndWhere('e.publishListing = 1');

        $query = $qb->getQuery();


        return $query->getSingleScalarResult();
    }


}
