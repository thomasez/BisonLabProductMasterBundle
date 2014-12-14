<?php

namespace BisonLab\ProductMasterBundle\Model\BillingPeriod;

class BillingPeriod
{
    const ONCE    = 'Once';
    const WEEKLY  = 'Weekly';
    const MONTHLY = 'Monthly';
    const YEARLY  = 'Yearly';

	protected static $availablePeriods = array(
		'ONCE'    => self::ONCE,
		'WEEKLY'  => self::WEEKLY,
		'MONTHLY' => self::MONTHLY,
		'YEARLY'  => self::YEARLY,
	);
  
    public static function create($billingPeriodName)
    {
      $className = 'BillingPeriod'. ucfirst(strtolower($billingPeriodName));
      return new $className();
    }

	public static function getAvailablePeriods()
	{
		return self::$availablePeriods;
	}

}
