<?
	if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
	if (!CModule::IncludeModule('iblock')) return;

	$filter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y');
	if ($merge = $GLOBALS[$arParams['FILTER_NAME']]) $filter = array_merge($filter, $merge);

	$list = CIBlockElement::GetList(array($arParams['SORT_BY'] => $arParams['SORT_ORDER']), $filter, false, array('nTopCount' => $arParams['COUNT']));

	while ($item = $list->GetNextElement()) {
		$element = $item->GetFields();
		$element['PROPERTIES'] = $item->GetProperties();

		$arButtons = CIBlock::GetPanelButtons($arParams['IBLOCK_ID'], $element['ID'], false, array('SESSID' => false));
		$element['EDIT_LINK'] = $arButtons['edit']['edit_element']['ACTION_URL'];
		$element['DELETE_LINK'] = $arButtons['edit']['delete_element']['ACTION_URL'];

		$arResult['ITEMS'][] = $element;
	}
?>
