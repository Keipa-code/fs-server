import React, { useContext } from 'react'
import { observer } from 'mobx-react-lite'
import { Context } from '../index'

const Selector = observer(() => {
  const DATE = '&sort=date'
  const FILENAME = '&sort=filename'
  const SIZE = '&sort=size'
  const ASC = '&order=ASC'
  const DESC = '&order=DESC'

  const { file } = useContext(Context)
  return (
    <div className="d-flex flex-row bd-highlight mt-5">
      <select
        className="form-select w-auto"
        onChange={(event) => {
          file.setSorting(event.target.name + event.target.value)
        }}
      >
        <option defaultValue={true} name={DATE} value={DESC}>
          Сначала новые
        </option>
        <option name={DATE} value={ASC}>
          Сначала старые
        </option>
        <option name={FILENAME} value={ASC}>
          По названию файла (А-Я)
        </option>
        <option name={FILENAME} value={DESC}>
          По названию файла (Я-А)
        </option>
        <option name={SIZE} value={ASC}>
          По размеру файла (возрастание)
        </option>
        <option name={SIZE} value={DESC}>
          По размеру файла (уменьшение)
        </option>
      </select>
    </div>
  )
})

export default Selector
