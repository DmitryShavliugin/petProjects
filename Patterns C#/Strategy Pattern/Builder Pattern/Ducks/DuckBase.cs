using Builder_Pattern.Fly;
using Builder_Pattern.Quack;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Builder_Pattern.Ducks
{
    abstract class DuckBase
    {
        protected IFly _flyable;
        protected IQuack _quackable;

        public DuckBase()
        {
            _quackable = new SimpleQuack();
            _flyable = new SimpleFlying();
        }

        public abstract void Display();

        public virtual void Quack()
        {
            _quackable.Quack();
        }

        public virtual void Fly()
        {
            _flyable.Fly();
        }

        public void Swim()
        {
            Console.WriteLine("I'm swimming");
        }
    }
}
