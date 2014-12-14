<?php

namespace BisonLab\ProductMasterBundle\Model\BillingPeriod;

class BillingPeriodWeekly extends BillingPeriod
{
  /**
   * getNextBillable
   * Calculates an extension date.
   * 
   * @return String
   **/
  public static function getNextBillableDate($fromDate, $amount = 1)      
  {

      if (!$fromDate) {
        $fromDate = date('Y-m-d', mktime(0, 0, 0));
      }
    
      list ($year, $month, $day) = explode("-", $fromDate);
    
      // Keep it simple for now.
  		$nbDate = date('Y-m-d', strtotime('next week', mktime(0, 0, 0, $month, $day, $year)));

error_log("From $fromDate ($year, $month, $day) i got " . $nbDate . " as next_billing");

      return $nbDate;

  }

  public function fraction($fromDate, $toDate)
  {

      $diff_seconds = strtotime($toDate) - strtotime($fromDate);

      // This is where we are talking about "How long is a month" and
      // also "Which month are we talking about". It can be this month
      // or next if the extension goes from like 14th to 14th.
      // This is why we say that a month have 30 days right now.
      
      $days = $diff_seconds = 86400;
      return ($days / 7);

  }

}
