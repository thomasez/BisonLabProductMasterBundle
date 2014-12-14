<?php

namespace BisonLab\ProductMasterBundle\Model\BillingPeriod;

class BillingPeriodMonthly extends BillingPeriod
{
    public $billingPeriods = array(
        1  => 31, 
        2  => 28, 
        3  => 31, 
        4  => 30, 
        5  => 31, 
        6  => 30, 
        7  => 31, 
        8  => 31, 
        9  => 30, 
        10 => 31, 
        11 => 30, 
        12 => 31, 
    );
  
  /**
   * getNextBillable
   * Calculates an extension date.
   *
   * Should we care about maxDate at all?
   * No.
   * 
   * @return String
   **/
  public static function getNextBillableDate($fromDate , $amount = 1)      
  {

    // I want to bloody sure I've got something.
    if (!$amount) { $amount = 1; }

    if (!$fromDate) {
      $fromDate = date('Y-m-d');
    }

    list ($year, $month, $day) = explode("-", $fromDate);

    // Keep it simple for now.
  	$nbDate = date('Y-m-d', strtotime("+$amount month", mktime(0, 0, 0, $month, $day, $year)));

error_log("From $fromDate ($year, $month, $day) i got " . $nbDate . " as next_billing");

    return $nbDate;

  }

  public function fraction($fromDate, $toDate)
  {

      if (!($toDate && $fromDate)) {
        throw new InvalidArgumentException('Missing from or to -date');
      }

      $diff_seconds = strtotime($toDate) - strtotime($fromDate);

      // This is where we are talking about "How long is a month" and
      // also "Which month are we talking about". It can be this month
      // or next if the extension goes from like 14th to 14th.
      // This is why we say that a month have 30 days right now.
      
      $days = $diff_seconds / 86400;
      $fraction = ($days / 30);
error_log("from: $fromDate, to:  $toDate, Diff: $diff_seconds Days:$days, Fraction: $fraction");
      return $fraction;

  }

}
