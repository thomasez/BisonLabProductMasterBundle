<?php

namespace BisonLab\ProductMasterBundle\Model\BillingPeriod;

class BillingPeriodOnce extends BillingPeriod
{
    /**
     * getNextBillable
     * Calculates an extension date.
     * 
     * @return String
     **/
    public static function getNextBillableDate($fromDate, $amount = 1)      
    {
      return null;
    }

    public function fraction($fromDate, $toDate)
    {

        $diff_seconds = strtotime($toDate) - strtotime($fromDate);
       

        // This is where we are talking about "How long is a month" and
        // also "Which month are we talking about". It can be this month
        // or next if the extension goes from like 14th to 14th.
        // This is why we say that a month have 30 days right now.
        
        return 0;

    }
}
