import React, { useContext } from 'react'
import { observer } from 'mobx-react-lite'
import { Context } from '../index'

const Selector = observer(() => {
  const { file } = useContext(Context)
  return (
    <div className="d-flex flex-row bd-highlight mt-5">
      <select
        className="form-select w-auto"
        onChange={(event) => {
          file.setSorting({
            sort: event.target.value.split(' ')[0],
            order: event.target.value.split(' ')[1],
          })
        }}
      >
        <option defaultValue={true} name="date" value="date DESC">
          Сначала новые
        </option>
        <option name="date" value="date ASC">
          Сначала старые
        </option>
        <option name="filename" value="filename ASC">
          По названию файла (А-Я)
        </option>
        <option name="filename" value="filename DESC">
          По названию файла (Я-А)
        </option>
        <option name="size" value="size ASC">
          По размеру файла (возрастание)
        </option>
        <option name="size" value="size DESC">
          По размеру файла (уменьшение)
        </option>
      </select>
    </div>
  )
})

export default Selector
