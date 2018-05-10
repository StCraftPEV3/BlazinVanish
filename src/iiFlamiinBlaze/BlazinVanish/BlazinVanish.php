use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\entity\Entity;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class BlazinVanish extends PluginBase{

    const PREFIX = "§6BlazinVanish§b > ";
    const VERSION = "v1.0.2";

    /** @var array $vanish */
    private $vanish = [];

    public function onEnable() : void{
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getLogger()->info("BlazinVanish " . self::VERSION . " by iiFlamiinBlaze has been enabled");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if($command->getName() === "vanish"){
            if(!$sender instanceof Player){
                $sender->sendMessage(self::PREFIX . TextFormat::RED . "Use this command in-game");
                return false;
            }
            if(!$sender->hasPermission("vanish.command")){
                $sender->sendMessage(self::PREFIX . TextFormat::RED . "You do not have permission to use this command");
                return false;
            }
            if(empty($args[0])){
                if(!in_array($sender->getName(), $this->vanish)){
                    $this->vanish[] = $sender->getName();
                    $sender->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_INVISIBLE, true);
                    $sender->setNameTagVisible(false);
                    $sender->sendMessage($this->getConfig()->get("vanished-message"));
                }elseif(in_array($sender->getName(), $this->vanish)){
                    unset($this->vanish[array_search($sender->getName(), $this->vanish)]);
                    $sender->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_INVISIBLE, false);
                    $sender->setNameTagVisible(true);
                    $sender->sendMessage($this->getConfig()->get("unvanished-message"));
                }
                return false;
            }
            if($this->getServer()->getPlayer($args[0])){
                $player = $this->getServer()->getPlayer($args[0]);
                if(!in_array($player->getName(), $this->vanish)){
                    $this->vanish[] = $player->getName();
                    $player->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_INVISIBLE, true);
                    $player->setNameTagVisible(false);
                    $player->sendMessage($this->getConfig()->get("vanished-message"));
                    $sender->sendMessage(self::PREFIX . TextFormat::GREEN . "You have vanished " . TextFormat::AQUA . $player->getName());
                }elseif(in_array($player->getName(), $this->vanish)){
                    unset($this->vanish[array_search($player->getName(), $this->vanish)]);
                    $player->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_INVISIBLE, false);
                    $player->setNameTagVisible(true);
                    $player->sendMessage($this->getConfig()->get("unvanished-message"));
                    $sender->sendMessage(self::PREFIX . TextFormat::GREEN . "You have un-vanished " . TextFormat::AQUA . $player->getName());
                }
            }else{
                $sender->sendMessage(self::PREFIX . TextFormat::RED . "Player not found");
                return false;
            }
        }
        return true;
    }
}
