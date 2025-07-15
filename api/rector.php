<?php

declare(strict_types=1);

return static function (\Rector\Config\RectorConfig $rectorConfig): void {
    $project_path = \getcwd();
    $rectorConfig->paths([
        $project_path . '/app',
        $project_path . '/config',
        $project_path . '/database',
        $project_path . '/routes',
    ]);

    $rectorConfig->phpVersion(\Rector\ValueObject\PhpVersion::PHP_83);
    $rectorConfig->parallel(512, new \Fidry\CpuCoreCounter\CpuCoreCounter(
        \Fidry\CpuCoreCounter\Finder\FinderRegistry::getDefaultLogicalFinders()
    )->getCount());

    $rules = [
        // Code Quality
        \Rector\CodeQuality\Rector\Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector::class,
        \Rector\CodeQuality\Rector\Identical\BooleanNotIdenticalToNotIdenticalRector::class,
        \Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector::class,
        \Rector\CodeQuality\Rector\If_\CombineIfRector::class,
        \Rector\CodeQuality\Rector\Assign\CombinedAssignRector::class,
        \Rector\CodeQuality\Rector\NotEqual\CommonNotEqualRector::class,
        \Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector::class,
        \Rector\CodeQuality\Rector\If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class,
        \Rector\CodeQuality\Rector\Foreach_\ForeachToInArrayRector::class,
        \Rector\CodeQuality\Rector\ClassMethod\InlineArrayReturnAssignRector::class,
        \Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector::class,
        \Rector\CodeQuality\Rector\Expression\InlineIfToExplicitIfRector::class,
        \Rector\CodeQuality\Rector\FuncCall\InlineIsAInstanceOfRector::class,
        \Rector\CodeQuality\Rector\Concat\JoinStringConcatRector::class,
        \Rector\CodeQuality\Rector\FuncCall\RemoveSoleValueSprintfRector::class,
        \Rector\CodeQuality\Rector\BooleanNot\ReplaceMultipleBooleanNotRector::class,
        \Rector\CodeQuality\Rector\Identical\SimplifyConditionsRector::class,
        \Rector\CodeQuality\Rector\If_\SimplifyIfElseToTernaryRector::class,
        \Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector::class,
        \Rector\CodeQuality\Rector\FunctionLike\SimplifyUselessVariableRector::class,
        \Rector\CodeQuality\Rector\Switch_\SingularSwitchToIfRector::class,
        \Rector\CodeQuality\Rector\Catch_\ThrowWithPreviousExceptionRector::class,
        \Rector\CodeQuality\Rector\Foreach_\UnusedForeachValueToArrayKeysRector::class,
        \Rector\CodeQuality\Rector\FuncCall\UnwrapSprintfOneArgumentRector::class,
        \Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector::class,

        // Dead code
        \Rector\DeadCode\Rector\Ternary\TernaryToBooleanOrFalseToBooleanAndRector::class,
        \Rector\DeadCode\Rector\Expression\SimplifyMirrorAssignRector::class,
        \Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnExprInConstructRector::class,
        \Rector\DeadCode\Rector\Assign\RemoveUnusedVariableAssignRector::class,
        \Rector\DeadCode\Rector\Property\RemoveUnusedPrivatePropertyRector::class,
        \Rector\DeadCode\Rector\Cast\RecastingRemovalRector::class,
        \Rector\DeadCode\Rector\If_\RemoveAlwaysTrueIfConditionRector::class,
        \Rector\DeadCode\Rector\BooleanAnd\RemoveAndTrueRector::class,
        \Rector\DeadCode\Rector\Return_\RemoveDeadConditionAboveReturnRector::class,
        \Rector\DeadCode\Rector\For_\RemoveDeadContinueRector::class,
        \Rector\DeadCode\Rector\For_\RemoveDeadIfForeachForRector::class,
        \Rector\DeadCode\Rector\If_\RemoveDeadInstanceOfRector::class,
        \Rector\DeadCode\Rector\FunctionLike\RemoveDeadReturnRector::class,
        \Rector\DeadCode\Rector\Expression\RemoveDeadStmtRector::class,
        \Rector\DeadCode\Rector\TryCatch\RemoveDeadTryCatchRector::class,
        \Rector\DeadCode\Rector\Plus\RemoveDeadZeroAndOneOperationRector::class,
        \Rector\DeadCode\Rector\Assign\RemoveDoubleAssignRector::class,
        \Rector\DeadCode\Rector\ClassMethod\RemoveEmptyClassMethodRector::class,
        \Rector\DeadCode\Rector\Node\RemoveNonExistingVarAnnotationRector::class,
        \Rector\DeadCode\Rector\StaticCall\RemoveParentCallWithoutParentRector::class,
        \Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector::class,
        \Rector\DeadCode\Rector\ClassMethod\RemoveUnusedConstructorParamRector::class,
        \Rector\DeadCode\Rector\Foreach_\RemoveUnusedForeachKeyRector::class,
        \Rector\DeadCode\Rector\If_\RemoveUnusedNonEmptyArrayBeforeForeachRector::class,
        \Rector\DeadCode\Rector\ClassConst\RemoveUnusedPrivateClassConstantRector::class,
        \Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodParameterRector::class,
        \Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector::class,
        \Rector\DeadCode\Rector\If_\SimplifyIfElseWithSameContentRector::class,
        \Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector::class,
        \Rector\DeadCode\Rector\For_\RemoveDeadLoopRector::class,
        \Rector\DeadCode\Rector\Switch_\RemoveDuplicatedCaseInSwitchRector::class,

        // Privatization
        \Rector\Privatization\Rector\Class_\FinalizeTestCaseClassRector::class,

        // PHP 8.1
        \Rector\Php81\Rector\ClassMethod\NewInInitializerRector::class,
        \Rector\Php81\Rector\Property\ReadOnlyPropertyRector::class,

        // Coding style
        \Rector\CodingStyle\Rector\Closure\StaticClosureRector::class,
        \Rector\CodingStyle\Rector\If_\NullableCompareToNullRector::class,

        // PHP 8.2
        \Rector\Php82\Rector\Class_\ReadOnlyClassRector::class,

        // PHP 8.3
        \Rector\Php83\Rector\ClassConst\AddTypeToConstRector::class,
        \Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector::class,

        // PHP 8.4
        \Rector\Php84\Rector\Param\ExplicitNullableParamTypeRector::class,

        // Laravel
        \RectorLaravel\Rector\MethodCall\AssertStatusToAssertMethodRector::class,
        \RectorLaravel\Rector\MethodCall\ValidationRuleArrayStringValueToArrayRector::class,
        \RectorLaravel\Rector\StaticCall\RouteActionCallableRector::class,
        \RectorLaravel\Rector\BooleanNot\AvoidNegatedCollectionContainsOrDoesntContainRector::class,
        \RectorLaravel\Rector\Class_\AnonymousMigrationsRector::class,
        \RectorLaravel\Rector\Class_\ModelCastsPropertyToCastsMethodRector::class,
    ];

    $rectorConfig->ruleWithConfiguration(\Rector\Transform\Rector\StaticCall\StaticCallToNewRector::class, [
        new \Rector\Transform\ValueObject\StaticCallToNew(\Carbon\CarbonImmutable::class, 'now'),
    ]);

    foreach ($rules as $rule) {
        $rectorConfig->rule($rule);
    }
};
