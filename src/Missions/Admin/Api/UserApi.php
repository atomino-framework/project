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

	protected function quickSearch(string $search): Filter {
		return Filter::where(User::name()->instring($search))
		             ->or(User::email()->instring($search))
		             ->or(User::id($search))
			;
	}

	protected function entityMapFilter(string $search): Filter|null {
		return Filter::where(User::name()->instring($search))
		             ->or(User::email()->instring($search))
			;
	}

	protected function entityMapLabel(Entity $item): string {
		/** @var User $item */
		return $item->name;
	}

	protected function listExport(Entity $item): array {
		/** @var User $item */
		$data = parent::listExport($item);
		$data['avatar'] = $item->avatar->first?->image->crop(64,64)->webp;
		return $data;
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

	#[GoldView('admins', 'Administrators')]
	protected function administratorsView(): Filter|null {
		return Filter::where(User::group(User::group__admin));
	}

	#[GoldSorting('name', 'name')]
	protected function nameSorting(bool $asc) {
		if ($asc) {
			return [[User::name, "asc"]];
		} else {
			return [[User::name, "desc"]];
		}
	}

}
