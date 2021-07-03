import React, { useContext } from 'react'
import { observer } from 'mobx-react-lite'
import { Context } from '../index'
import { Pagination } from 'react-bootstrap'

const Pages = observer(() => {
  const { file } = useContext(Context)
  const pageCount = Math.ceil(file.totalCount / file.limit)
  const pages = []

  for (let i = 0; i < pageCount; i++) {
    pages.push(i + 1)
  }

  return (
    <Pagination className="mt-3">
      {pages.map((page) => (
        <Pagination.Item
          key={page}
          active={file.page === page}
          onClick={() => {
            file.setPage(page)
            file.setSorting(file.sorting + '&page=' + page)
          }}
        >
          {page}
        </Pagination.Item>
      ))}
    </Pagination>
  )
})

export default Pages
