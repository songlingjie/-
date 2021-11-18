<?php
/**
 * Created by PhpStorm.
 * User: songlingjie
 * Date: 11/16/21
 * Time: 3:20 PM
 */

/**
 * 定义：顾名思义就是共享一组单元
 * 举例：比如多个棋局中都有车马炮这些棋子对象，这相同的棋子的共享单元是名称和颜色
 * 思考：意图是共享对象，节省内存
 */


/**
 * 棋子共享单元
 * Class pieceUnit
 */
class PieceUnit
{
    protected $id;
    protected $text;
    protected $color;

    public function __construct($id)
    {
        $this->id = $id;
        $this->setText($id);
        $this->setColor($id);
    }

    private function setText($id)
    {
        $this->text = 'id2Text';
    }

    private function setColor($id)
    {
        $this->color = 'id2Color';
    }
}


/**
 * 棋子共享单元工厂
 * Class PieceUnitFactory
 */
class PieceUnitFactory
{
    private static $pieceUnitMap = [];

    public static function getPieceUnitInstance($id)
    {
        if (!isset(self::$pieceUnitMap[$id])) {
            $lock = true;
            // 使用双重检测，避免并发
            if ($lock) {
                if (!isset($pieceUnitMap[$id])) {
                    self::$pieceUnitMap[$id] = new PieceUnit($id);
                }
            }
        }
        return self::$pieceUnitMap[$id];
    }
}

/**
 * 棋子类
 * Class Piece
 */
class Piece
{
    /**
     * @var int 坐标X
     */
    protected $positionX;

    /**
     * @var int 坐标Y
     */
    protected $positionY;

    /**
     * @var PieceUnit
     */
    protected $pieceUnit;

    /**
     * piece constructor.
     * @param PieceUnit $pieceUnit
     * @param int       $positionX
     * @param int       $positionY
     */
    public function __construct(PieceUnit $pieceUnit, $positionX, $positionY)
    {
        $this->pieceUnit = $pieceUnit;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
    }

    /**
     * @param int $toX
     * @param int $toY
     */
    public function move($toX, $toY)
    {
        $this->positionX = $toX;
        $this->positionY = $toY;
    }
}

/**
 * 棋局类
 * Class ChessBoard
 */
class ChessBoard
{

    protected $chessPieces = [];

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        // 摆放棋子
        $this->chessPieces[1] = new Piece(PieceUnitFactory::getPieceUnitInstance(1),1,2);
        $this->chessPieces[2] = new Piece(PieceUnitFactory::getPieceUnitInstance(2),2,3);
    }

    public function move($id, $toX, $toY)
    {
        $this->chessPieces[$id]->move($toX, $toY);
    }
}


$chessBoard1 = new ChessBoard();

$chessBoard2 = new ChessBoard();

$chessBoard3 = new ChessBoard();

// 我们创建3个棋局 每个棋子的共享单元只实例化了一次