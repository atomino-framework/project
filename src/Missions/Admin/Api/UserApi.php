<?php namespace Application\Missions\Admin\Api;

use Application\Entity\User;
use Atomino\Gold\Gold;
use Atomino\Gold\GoldApi;
use Atomino\Gold\GoldSorting;
use Atomino\Gold\GoldView;
use Atomino\Carbon\Database\Finder\Filter;
use Atomino\Carbon\Entity;

#[Gold(User::class, 5, true)]
class UserApi extends GoldApi {

	protected function addViews(): void {
		parent::addViews();
		$this->addView(new GoldView('unba', '20nál kisebb', fn() => Filter::where(User::id()->lt(20))));
	}

	protected function quickSearch(string $search): Filter {
		return Filter::where(User::name()->instring($search))
		             ->or(User::email()->instring($search))
		             ->or(User::id($search))
			;
	}

	protected function selectFilter(string $search): Filter|null {
		return Filter::where(User::name()->instring($search))
		             ->or(User::email()->instring($search))
			;
	}

	protected function selectMap(Entity $item): string {
		/** @var User $item */
		return $item->name;
	}

	protected function formExport(Entity $item): array {
		$data = $item->export();
		$data['password'] = "";
		return $data;
	}

	protected function updateItem(Entity $item, array $data):int|null {
		/** @var User $item */
		if ($data['password'] === "") unset($data['password']);
		else $item->setPassword($data["password"]);
		parent::updateItem($item, $data);
	}


	#[GoldView('*', '-')]
	protected function allView(): Filter|null {
		return null;
	}

	#[GoldView('banned', '20nál nagyobb userek')]
	protected function bannedView(): Filter|null {
		return Filter::where(User::id()->gt(20));
	}

	#[GoldSorting('name', 'név')]
	protected function nameSorting(bool $asc) {
		if ($asc) {
			return [[User::name, "asc"]];
		} else {
			return [[User::name, "desc"]];
		}
	}

	#[GoldSorting('email', 'e-mail')]
	protected function emailSorting(bool $asc) {
		if ($asc) {
			return [[User::email, "asc"]];
		} else {
			return [[User::email, "desc"], [User::name, "asc"]];
		}
	}
}
