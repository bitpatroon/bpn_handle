# bpn_handle

Allows to set handles on pages, tt_content and usergroups.
Technically allows the developer to retrieve records using handles.

Retrieve a record by calling

```
/** @var \BPN\BpnHandle\Domain\Repository\PageRepository $pageRepository
$pageRepository->findByHandle($handle);
```

retrieves the pages by a string handle. Returns all records containg this handle.
The collection (array) is associative by uid.

Similarly works for usergroups:

```
/** @var \BPN\BpnHandle\Domain\Repository\FrontendUserGroupRepository $repository
$repository->findByHandle($handle);
```
 and content:

```
/** @var \BPN\BpnHandle\Domain\Repository\ContentRepository $repository
$repository->findByHandle($handle);
```

## Thanks to
Many thanks for the concept by Frans van der Veen
<br/>May the force be with you!

Ported to TYPO3 10.4 by Sjoerd Zonneveld
