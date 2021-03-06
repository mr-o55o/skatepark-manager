<?php
namespace App\Model\Behavior;

use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 * A convenience wrapper for calendar querying.
 *
 * Use as find('calendar') after attaching the behavior to a Table class.
 *
 * @author Mark Scherer
 * @license MIT
 */
class WeeklyCalendarBehavior extends Behavior {

	//const YEAR = 'year';
	//const MONTH = 'month';

	/**
	 * @var \Cake\ORM\Table
	 */
	protected $_table;

	/**
	 * @var array
	 */
	protected $_defaultConfig = [
		'field' => 'date',
		'endField' => null,
		'implementedFinders' => [
			'weeklyCalendar' => 'findWeeklyCalendar',
		],
		'scope' => [],
	];

	/**
	 * Constructor
	 *
	 * Merges config with the default and store in the config property
	 *
	 * Does not retain a reference to the Table object. If you need this
	 * you should override the constructor.
	 *
	 * @param \Cake\ORM\Table $table The table this behavior is attached to.
	 * @param array $config The config for this behavior.
	 */
	public function __construct(Table $table, array $config = []) {
		$defaults = (array)Configure::read('WeeklyCalendar');
		parent::__construct($table, $config + $defaults);

		$this->_table = $table;
	}

	/**
	 * Custom finder for Calendars field.
	 *
	 * Options:
	 * - year (required), best to use CalendarBehavior::YEAR constant
	 * - month (required), best to use CalendarBehavior::MONTH constant
	 *
	 * @param \Cake\ORM\Query $query Query.
	 * @param array $options Array of options as described above
	 * @return \Cake\ORM\Query
	 */
	public function findWeeklyCalendar(Query $query, array $options) {
		$field = $this->config('field');

		//$year = $options[static::YEAR];
		//$month = $options[static::MONTH];

		$from = Time::now()->startOfWeek()->startOfDay();
		//$lastDayOfMonth = $from->daysInMonth;

		$to = Time::now()->endOfWeek()->endOfDay();

		$conditions = [
			$field . ' >=' => $from,
			$field . ' <=' => $to
		];
		if ($this->config('endField')) {
			$endField = $this->config('endField');

			$conditions = [
				'OR' => [
					[
						$field . ' <=' => $to,
						$endField . ' >' => $from,
					],
					$conditions
				]
			];
		}

		$query->where($conditions);
		if ($this->config('scope')) {
			$query->andWhere($this->config('scope'));
		}

		return $query;
	}

}
