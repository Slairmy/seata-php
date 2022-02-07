<?php

namespace Hyperf\Seata\SqlParser\Antlr\MySql\Listener;

use Antlr\Antlr4\Runtime\ParserRuleContext;
use Hyperf\Seata\SqlParser\Antlr\MySql\Parser\Context;
use Hyperf\Seata\SqlParser\Antlr\MySql\Visit\StatementSqlVisitor;
use Hyperf\Seata\SqlParser\Antlr\MySqlContext;

class SelectSpecificationSqlListener extends MySqlParserBaseListener
{
    private MySqlContext $sqlQueryContext;

    public function __construct(MySqlContext $sqlQueryContext)
    {
        $this->sqlQueryContext = $sqlQueryContext;
    }

    public function enterTableName(Context\TableNameContext $context): void
    {
        $this->sqlQueryContext->setTableName($context->getText());
        parent::enterTableName($context);
    }

    public function enterAtomTableItem(Context\AtomTableItemContext $context): void
    {
        $uid = $context->uid();
        if (! empty($uid)) {
            $text = $uid->getText();
            if (! empty($text)) {
                $this->sqlQueryContext->setTableAlias($text);
            }
        }
        parent::enterAtomTableItem($context); // TODO: Change the autogenerated stub
    }

    public function enterFromClause(Context\FromClauseContext $context): void
    {
        $whereExpr = $context->whereExpr;
        $statementSqlVisitor = new StatementSqlVisitor();
        $text = (string) $statementSqlVisitor->visit($whereExpr);
        $this->sqlQueryContext->setWhereCondition($text);
        parent::enterFromClause($context); // TODO: Change the autogenerated stub
    }

    public function enterFullColumnNameExpressionAtom(Context\FullColumnNameExpressionAtomContext $context): void
    {
        $this->sqlQueryContext->addQueryWhereColumnNames($context->getText());
        parent::enterFullColumnNameExpressionAtom($context); // TODO: Change the autogenerated stub
    }

    public function enterConstantExpressionAtom(Context\ConstantExpressionAtomContext $context): void
    {
        $this->sqlQueryContext->addQueryWhereValColumnNames($context->getText());
        parent::enterConstantExpressionAtom($context); // TODO: Change the autogenerated stub
    }

    public function enterSelectElements(Context\SelectElementsContext $context): void
    {
        $selectElementContexts = $context->selectElement();
        foreach ($selectElementContexts as $elementContext) {
            $this->sqlQueryContext->addQueryColumnNames($elementContext->getText());
        }
        parent::enterSelectElements($context); // TODO: Change the autogenerated stub
    }
}