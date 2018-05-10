 Preview changes
1
<?php
2
/**
3
 *  ____  _            _______ _          _____
4
 * |  _ \| |          |__   __| |        |  __ \
5
 * | |_) | | __ _ _______| |  | |__   ___| |  | | _____   __
6
 * |  _ <| |/ _` |_  / _ \ |  | '_ \ / _ \ |  | |/ _ \ \ / /
7
 * | |_) | | (_| |/ /  __/ |  | | | |  __/ |__| |  __/\ V /
8
 * |____/|_|\__,_/___\___|_|  |_| |_|\___|_____/ \___| \_/
9
 *
10
 * Copyright (C) 2018 iiFlamiinBlaze
11
 *
12
 * iiFlamiinBlaze's plugins are licensed under MIT license!
13
 * Made by iiFlamiinBlaze for the PocketMine-MP Community!
14
 *
15
 * @author iiFlamiinBlaze
16
 * Twitter: https://twitter.com/iiFlamiinBlaze
17
 * GitHub: https://github.com/iiFlamiinBlaze
18
 * Discord: https://discord.gg/znEsFsG
19
 */
20
declare(strict_types=1);
21
​
22
namespace iiFlamiinBlaze\BlazinVanish;
23
​
24
use pocketmine\command\Command;
25
use pocketmine\command\CommandSender;
26
use pocketmine\entity\Effect;
27
use pocketmine\entity\EffectInstance;
28
use pocketmine\entity\Entity;
29
use pocketmine\Player;
30
use pocketmine\plugin\PluginBase;
31
use pocketmine\utils\TextFormat;
32
​
33
class BlazinVanish extends PluginBase{
34
​
35
    const PREFIX = "§6BlazinVanish§b > ";
36
    const VERSION = "v1.0.2";
37
​
38
    /** @var array $vanish */
39
    private $vanish = [];
40
​
41
    public function onEnable() : void{
42
        @mkdir($this->getDataFolder());
43
        $this->saveDefaultConfig();
44
        $this->getLogger()->info("BlazinVanish " . self::VERSION . " by iiFlamiinBlaze has been enabled");
45
    }
46
​
47
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
48
        if($command->getName() === "vanish"){
49
            if(!$sender instanceof Player){
50
