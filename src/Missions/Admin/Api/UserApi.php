<?php namespace Application\Missions\Admin\Api;

use Application\Entity\User;
use Atomino\Gold\Gold;
use Atomino\Gold\GoldApi;
use Atomino\Gold\Goldify;
use Atomino\Gold\GoldSorting;
use Atomino\Gold\GoldView;
use Atomino\Carbon\Database\Finder\Filter;
use Atomino\Carbon\Entity;
use Atomino\Gold\ItemApi;
use Atomino\Gold\ListApi;
use Atomino\Gold\ListSorting;
use Atomino\Gold\ListView;
use Atomino\Mercury\Responder\Api\Api;
use Atomino\Mercury\Responder\Api\Attributes\Route;

#[Goldify(User::class)]
class UserApi extends Gold {

	protected function listApi(): ListApi {
		return new class($this, 50, true) extends ListApi {
			public function views(): array { return [
			]; }
			public function sortings(): array {
				return [
					new ListSorting("name", fn($asc) => $asc ? [[User::name, "asc"]] : [[User::name, "desc"]]),
				];
			}
			public function quickSearchFilter(string $search): Filter {
				return Filter::where(User::name()->instring($search))
				             ->or(User::email()->instring($search))
				             ->or(User::id($search))
				;
			}
		};
	}

	protected function itemApi(): ItemApi {
		return new class($this) extends ItemApi {
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

	protected function customApi(): Api|null {
		return new class() extends Api {
			#[Route("POST", "get-groups")]
			public function POST_getGroups() {
				return User::model()->getField("group")->getOptions();
			}
		};
	}

}
