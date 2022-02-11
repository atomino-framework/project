<?php namespace Application\Missions\Admin\Api;

use Application\Entity\User;
use Atomino\Gold\Gold;
use Atomino\Gold\Goldify;
use Atomino\Carbon\Database\Finder\Filter;
use Atomino\Carbon\Entity;
use Atomino\Gold\ItemApi;
use Atomino\Gold\ListApi;
use Atomino\Gold\ListSorting;
use Atomino\Gold\ListView;
use Atomino\Mercury\Responder\Api\Api;

#[Goldify(User::class, User::ROLE_ADMIN)]
class UserApi extends Gold {

	protected function listApi(): ListApi {
		return new class($this, 50, true) extends ListApi {
			public function views(): array {
				return [
					new ListView("Everybody", fn() => null),
					new ListView("Administrators", fn() => Filter::where(User::group(User::group__admin))),
					new ListView("Visitors", fn() => Filter::where(User::group(User::group__visitor))),
				];
			}
			public function sortings(): array {
				return [
					new ListSorting("name", fn($asc) => $asc ? [[User::name, "asc"]] : [[User::name, "desc"]]),
				];
			}
			public function export(Entity|User $item): array {
				$data = parent::export($item);
				unset($data['password']);
				$data['avatar'] = $item->avatar->first?->image->crop(64, 64)->png;
				return $data;
			}

			public function searchFilter(array $filter): Filter|null {
				return Filter::where(isset($filter['email']) && $filter['email'] ? User::email()->instring($filter['email']) : null);
			}
			public function quickSearchFilter(string $search): Filter {
				return Filter::where(User::name()->instring($search))
				             ->or(User::id($search))
				;
			}
		};
	}

	protected function itemApi(): ItemApi {
		return new class($this) extends ItemApi {
			protected function options(Entity|null $item): array|null {
				return ["groups" => User::model()->getField(User::group)->getOptions()];
			}
			protected function export(Entity|User $item): array {
				$data = parent::export($item);
				$data['password'] = "";
				return $data;
			}
			protected function update(Entity|User $item, array $data): int|null {
				if ($data['password'] === "") unset($data['password']);
				else $item->setPassword($data["password"]);
				return parent::update($item, $data);
			}
		};
	}

	// you can add any custom api calls on top of the base calls
	protected function customApi(): Api|null {
		return new class ( ) extends Api { };
	}

}
